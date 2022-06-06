<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\SchedulesFindersResponse;
use Mvc\Application\Query\ScheduleFindersQuery;
use Mvc\Domain\Repository\ScheduleRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\Schedule;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class ScheduleFindersService implements QueryHandler
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

    public function __invoke(ScheduleFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        $res = $this->scheduleRepository->findAllByUser($user->getId());
        return array_map(function (Schedule $schedule) {
            $serialized = new SchedulesFindersResponse($schedule);
            return $serialized->toArray();
        }, $res);
    }

    public function subscribedTo(): string
    {
        return ScheduleFindersQuery::class;
    }

    /**
     * @param ScheduleFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
