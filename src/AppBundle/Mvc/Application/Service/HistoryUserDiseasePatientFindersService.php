<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\HistoryUserDiseaseFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\HistoryUserDiseasePatientFindersQuery;
use Mvc\Domain\HistoryUserDisease;
use Mvc\Domain\Repository\HistoryUserDiseaseRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HistoryUserDiseasePatientFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var HistoryUserDiseaseRepository */
    private $historyUserDiseaseRepository;

    public function __construct(
        UserRepository $userRepository,
        HistoryUserDiseaseRepository $historyUserDiseaseRepository
    ) {
        $this->userRepository = $userRepository;
        $this->historyUserDiseaseRepository = $historyUserDiseaseRepository;
    }

    public function __invoke(HistoryUserDiseasePatientFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }
        $res = $this->historyUserDiseaseRepository->findAllByUserId($query->patient());
        return array_map(function (HistoryUserDisease $historyUserDisease) {
            $serialized = new HistoryUserDiseaseFindersResponse($historyUserDisease);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return HistoryUserDiseasePatientFindersQuery::class;
    }

    /**
     * @param HistoryUserDiseasePatientFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
