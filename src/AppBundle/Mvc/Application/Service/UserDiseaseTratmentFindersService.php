<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\UserDiseaseTreatmentFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\UserDiseaseTreatmentFindersQuery;
use Mvc\Domain\Repository\HistoryUserDiseaseRepository;
use Mvc\Domain\Repository\UserDiseaseTreatmentRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\UserDiseaseTreatment;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class UserDiseaseTratmentFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var UserDiseaseTreatmentRepository */
    private $userDiseaseTreatmentRepository;
    /** @var HistoryUserDiseaseRepository */
    private $historyUserDiseaseRepository;

    public function __construct(
        UserRepository $userRepository,
        UserDiseaseTreatmentRepository $userDiseaseTreatmentRepository,
        HistoryUserDiseaseRepository $historyUserDiseaseRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userDiseaseTreatmentRepository = $userDiseaseTreatmentRepository;
        $this->historyUserDiseaseRepository = $historyUserDiseaseRepository;
    }

    public function __invoke(UserDiseaseTreatmentFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        $history = $this->historyUserDiseaseRepository->find($query->id());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $treatments = $this->userDiseaseTreatmentRepository->findAllByHistoryDisease($history->getId());
        return array_map(function (UserDiseaseTreatment $treatment) {
            $serialized = new UserDiseaseTreatmentFindersResponse($treatment);
            return $serialized->toArray();
        }, $treatments);
    }

    public function subscribedTo(): string
    {
        return UserDiseaseTreatmentFindersQuery::class;
    }

    /**
     * @param UserDiseaseTreatmentFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
