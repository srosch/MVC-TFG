<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\HistoryUserDonationsFindersResponse;
use Mvc\Application\Query\HistoryUserDonationsFindersQuery;
use Mvc\Domain\HistoryUserDonations;
use Mvc\Domain\Repository\HistoryUserDonationsRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HistoryUserDonationsFindersService implements QueryHandler
{
    /** @var HistoryUserDonationsRepository */
    private $historyUserDonationsRepository;

    public function __construct(
        HistoryUserDonationsRepository $historyUserDonationsRepository
    ) {
        $this->historyUserDonationsRepository = $historyUserDonationsRepository;
    }

    public function __invoke(HistoryUserDonationsFindersQuery $query): array
    {
        $res = $this->historyUserDonationsRepository->findAllByUserId($query->userId());
        return array_map(function (HistoryUserDonations $historyUserDonations) {
            $serialized = new HistoryUserDonationsFindersResponse($historyUserDonations);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return HistoryUserDonationsFindersQuery::class;
    }

    /**
     * @param HistoryUserDonationsFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
