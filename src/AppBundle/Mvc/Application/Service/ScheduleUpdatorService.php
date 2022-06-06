<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\ScheduleUpdatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\Repository\ScheduleRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class ScheduleUpdatorService implements CommandHandler
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

    public function __invoke(ScheduleUpdatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isAdministrative()) {
            throw new UserHasNotPermissionToAccess();
        }

        $schedule = $this->scheduleRepository->find($command->id());
        $schedule->setDate(new \DateTimeImmutable($command->date()));

        $this->scheduleRepository->update($schedule);
    }

    public function subscribedTo(): string
    {
        return ScheduleUpdatorCommand::class;
    }

    /**
     * @param ScheduleUpdatorCommand $command
     */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
