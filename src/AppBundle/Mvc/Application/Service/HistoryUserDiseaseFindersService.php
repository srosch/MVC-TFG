<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\HistoryUserDiseaseFindersResponse;
use Mvc\Application\Query\HistoryUserDiseaseFindersQuery;
use Mvc\Domain\HistoryUserDisease;
use Mvc\Domain\Repository\HistoryUserDiseaseRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HistoryUserDiseaseFindersService implements QueryHandler
{
    /** @var HistoryUserDiseaseRepository */
    private $historyUserDiseaseRepository;

    public function __construct(
        HistoryUserDiseaseRepository $historyUserDiseaseRepository
    ) {
        $this->historyUserDiseaseRepository = $historyUserDiseaseRepository;
    }

    public function __invoke(HistoryUserDiseaseFindersQuery $query): array
    {
        $res = $this->historyUserDiseaseRepository->findAllByUserId($query->userId());
        return array_map(function (HistoryUserDisease $historyUserDisease) {
            $serialized = new HistoryUserDiseaseFindersResponse($historyUserDisease);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return HistoryUserDiseaseFindersQuery::class;
    }

    /**
     * @param HistoryUserDiseaseFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
