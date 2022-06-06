<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\DiseaseFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\DiseaseFindersQuery;
use Mvc\Domain\Disease;
use Mvc\Domain\Repository\DiseaseRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class DiseaseFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var DiseaseRepository */
    private $diseaseRepository;
    public function __construct(
        UserRepository $userRepository,
        DiseaseRepository $diseaseRepository
    ) {
        $this->userRepository = $userRepository;
        $this->diseaseRepository = $diseaseRepository;
    }

    public function __invoke(DiseaseFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }
        $diseases = $this->diseaseRepository->findAll();
        return array_map(function (Disease $disease) {
            $serialized = new DiseaseFindersResponse($disease);
            return $serialized->toArray();
        }, $diseases);
    }

    public function subscribedTo(): string
    {
        return DiseaseFindersQuery::class;
    }

    /**
     * @param DiseaseFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
