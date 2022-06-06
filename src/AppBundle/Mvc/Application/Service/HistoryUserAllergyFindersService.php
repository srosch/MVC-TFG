<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\HistoryUserAllergyFindersResponse;
use Mvc\Application\Query\HistoryUserAllergyFindersQuery;
use Mvc\Domain\HistoryUserAllergy;
use Mvc\Domain\Repository\HistoryUserAllergyRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HistoryUserAllergyFindersService implements QueryHandler
{
    /** @var HistoryUserAllergyRepository */
    private $historyUserAllergyRepository;

    public function __construct(
        HistoryUserAllergyRepository $historyUserAllergyRepository
    ) {
        $this->historyUserAllergyRepository = $historyUserAllergyRepository;
    }

    public function __invoke(HistoryUserAllergyFindersQuery $query): array
    {
        $res = $this->historyUserAllergyRepository->findAllByUserId($query->userId());
        return array_map(function (HistoryUserAllergy $historyUserAllergy) {
            $serialized = new HistoryUserAllergyFindersResponse($historyUserAllergy);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return HistoryUserAllergyFindersQuery::class;
    }

    /**
     * @param HistoryUserAllergyFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
