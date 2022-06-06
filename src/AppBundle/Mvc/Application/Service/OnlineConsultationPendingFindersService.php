<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\OnlineConsultationFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\OnlineConsultationPendingFindersQuery;
use Mvc\Domain\OnlineConsultation;
use Mvc\Domain\Repository\OnlineConsultationRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class OnlineConsultationPendingFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var OnlineConsultationRepository */
    private $onlineConsultationRepository;

    public function __construct(
        UserRepository $userRepository,
        OnlineConsultationRepository $onlineConsultationRepository
    ) {
        $this->userRepository = $userRepository;
        $this->onlineConsultationRepository = $onlineConsultationRepository;
    }

    public function __invoke(OnlineConsultationPendingFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $pending = $this->onlineConsultationRepository->findPending();
        return array_map(function (OnlineConsultation $onlineConsultation) {
            $serialized = new OnlineConsultationFindersResponse($onlineConsultation);
            return $serialized->toArray();
        }, $pending);
    }

    public function subscribedTo(): string
    {
        return OnlineConsultationPendingFindersQuery::class;
    }

    /**
     * @param OnlineConsultationPendingFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
