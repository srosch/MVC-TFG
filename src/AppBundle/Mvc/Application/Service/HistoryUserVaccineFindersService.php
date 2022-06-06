<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\HistoryUserVaccineFindersResponse;
use Mvc\Application\Query\HistoryUserVaccineFindersQuery;
use Mvc\Domain\HistoryUserVaccine;
use Mvc\Domain\Repository\HistoryUserVaccineRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HistoryUserVaccineFindersService implements QueryHandler
{
    /** @var HistoryUserVaccineRepository */
    private $historyUserVaccineRepository;

    public function __construct(
        HistoryUserVaccineRepository $historyUserVaccineRepository
    ) {
        $this->historyUserVaccineRepository = $historyUserVaccineRepository;
    }

    public function __invoke(HistoryUserVaccineFindersQuery $query): array
    {
        $res = $this->historyUserVaccineRepository->findAllByUserId($query->userId());
        return array_map(function (HistoryUserVaccine $historyUserVaccine) {
            $serialized = new HistoryUserVaccineFindersResponse($historyUserVaccine);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return HistoryUserVaccineFindersQuery::class;
    }

    /**
     * @param HistoryUserVaccineFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
