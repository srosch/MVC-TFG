<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\HistoryUserVaccineFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\HistoryUserVaccinePatientFindersQuery;
use Mvc\Domain\HistoryUserVaccine;
use Mvc\Domain\Repository\HistoryUserVaccineRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HistoryUserVaccinePatientFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var HistoryUserVaccineRepository */
    private $historyUserVaccineRepository;

    public function __construct(
        UserRepository $userRepository,
        HistoryUserVaccineRepository $historyUserVaccineRepository
    ) {
        $this->userRepository = $userRepository;
        $this->historyUserVaccineRepository = $historyUserVaccineRepository;
    }

    public function __invoke(HistoryUserVaccinePatientFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }
        $res = $this->historyUserVaccineRepository->findAllByUserId($query->patient());
        return array_map(function (HistoryUserVaccine $historyUserVaccine) {
            $serialized = new HistoryUserVaccineFindersResponse($historyUserVaccine);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return HistoryUserVaccinePatientFindersQuery::class;
    }

    /**
     * @param HistoryUserVaccinePatientFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
