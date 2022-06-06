<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\HistoryUserDonationsFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\HistoryUserDonationsPatientFindersQuery;
use Mvc\Domain\HistoryUserDonations;
use Mvc\Domain\Repository\HistoryUserDonationsRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HistoryUserDonationsPatientFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var HistoryUserDonationsRepository */
    private $historyUserDonationsRepository;

    public function __construct(
        UserRepository $userRepository,
        HistoryUserDonationsRepository $historyUserDonationsRepository
    ) {
        $this->userRepository = $userRepository;
        $this->historyUserDonationsRepository = $historyUserDonationsRepository;
    }

    public function __invoke(HistoryUserDonationsPatientFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }
        $res = $this->historyUserDonationsRepository->findAllByUserId($query->patient());
        return array_map(function (HistoryUserDonations $historyUserDonations) {
            $serialized = new HistoryUserDonationsFindersResponse($historyUserDonations);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return HistoryUserDonationsPatientFindersQuery::class;
    }

    /**
     * @param HistoryUserDonationsPatientFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
