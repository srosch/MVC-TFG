<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\SchedulesFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\SchedulePatientFindersQuery;
use Mvc\Domain\Repository\ScheduleRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\Schedule;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class SchedulePatientFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var ScheduleRepository */
    private $scheduleRepository;

    public function __construct(
        UserRepository $userRepository,
        ScheduleRepository $scheduleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->scheduleRepository = $scheduleRepository;
    }

    public function __invoke(SchedulePatientFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if ($user->isPatient() && $user->getId() !== $query->patient()) {
            throw new UserHasNotPermissionToAccess();
        }
        if (!$user->isAdministrative() && !$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }
        $res = $this->scheduleRepository->findAllByUser($query->patient());
        return array_map(function (Schedule $schedule) {
            $serialized = new SchedulesFindersResponse($schedule);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return SchedulePatientFindersQuery::class;
    }

    /**
     * @param SchedulePatientFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
