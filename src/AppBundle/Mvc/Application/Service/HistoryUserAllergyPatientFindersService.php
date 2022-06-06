<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\HistoryUserAllergyFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\HistoryUserAllergyPatientFindersQuery;
use Mvc\Domain\HistoryUserAllergy;
use Mvc\Domain\Repository\HistoryUserAllergyRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HistoryUserAllergyPatientFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var HistoryUserAllergyRepository */
    private $historyUserAllergyRepository;

    public function __construct(
        UserRepository $userRepository,
        HistoryUserAllergyRepository $historyUserAllergyRepository
    ) {
        $this->userRepository = $userRepository;
        $this->historyUserAllergyRepository = $historyUserAllergyRepository;
    }

    public function __invoke(HistoryUserAllergyPatientFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }
        $res = $this->historyUserAllergyRepository->findAllByUserId($query->patient());
        return array_map(function (HistoryUserAllergy $historyUserAllergy) {
            $serialized = new HistoryUserAllergyFindersResponse($historyUserAllergy);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return HistoryUserAllergyPatientFindersQuery::class;
    }

    /**
     * @param HistoryUserAllergyPatientFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
