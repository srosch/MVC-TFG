<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\VaccineFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\VaccineFindersQuery;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\Repository\VaccineRepository;
use Mvc\Domain\Vaccine;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class VaccineFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var VaccineRepository */
    private $vaccineRepository;
    public function __construct(
        UserRepository $userRepository,
        VaccineRepository $vaccineRepository
    ) {
        $this->userRepository = $userRepository;
        $this->vaccineRepository = $vaccineRepository;
    }

    public function __invoke(VaccineFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $vaccines = $this->vaccineRepository->findAll();

        return array_map(function (Vaccine $vaccines) {
            $serialized = new VaccineFindersResponse($vaccines);
            return $serialized->toArray();
        }, $vaccines);
    }

    public function subscribedTo(): string
    {
        return VaccineFindersQuery::class;
    }

    /**
     * @param VaccineFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
