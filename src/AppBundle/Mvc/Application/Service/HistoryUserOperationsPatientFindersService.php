<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\HistoryUserOperationsFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\HistoryUserOperationsPatientFindersQuery;
use Mvc\Domain\HistoryUserOperations;
use Mvc\Domain\Repository\HistoryUserOperationsRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HistoryUserOperationsPatientFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var HistoryUserOperationsRepository */
    private $historyUserOperationsRepository;

    public function __construct(
        UserRepository $userRepository,
        HistoryUserOperationsRepository $historyUserOperationsRepository
    ) {
        $this->userRepository = $userRepository;
        $this->historyUserOperationsRepository = $historyUserOperationsRepository;
    }

    public function __invoke(HistoryUserOperationsPatientFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }
        $res = $this->historyUserOperationsRepository->findAllByUserId($query->patient());
        return array_map(function (HistoryUserOperations $historyUserOperations) {
            $serialized = new HistoryUserOperationsFindersResponse($historyUserOperations);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return HistoryUserOperationsPatientFindersQuery::class;
    }

    /**
     * @param HistoryUserOperationsPatientFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
