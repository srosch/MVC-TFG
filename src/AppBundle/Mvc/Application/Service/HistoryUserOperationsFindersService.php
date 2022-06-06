<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\HistoryUserOperationsFindersResponse;
use Mvc\Application\Query\HistoryUserOperationsFindersQuery;
use Mvc\Domain\HistoryUserOperations;
use Mvc\Domain\Repository\HistoryUserOperationsRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HistoryUserOperationsFindersService implements QueryHandler
{
    /** @var HistoryUserOperationsRepository */
    private $historyUserOperationsRepository;

    public function __construct(
        HistoryUserOperationsRepository $historyUserOperationsRepository
    ) {
        $this->historyUserOperationsRepository = $historyUserOperationsRepository;
    }

    public function __invoke(HistoryUserOperationsFindersQuery $query): array
    {
        $res = $this->historyUserOperationsRepository->findAllByUserId($query->userId());
        return array_map(function (HistoryUserOperations $historyUserOperations) {
            $serialized = new HistoryUserOperationsFindersResponse($historyUserOperations);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return HistoryUserOperationsFindersQuery::class;
    }

    /**
     * @param HistoryUserOperationsFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
