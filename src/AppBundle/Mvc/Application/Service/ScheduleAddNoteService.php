<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\ScheduleAddNoteCommand;
use Mvc\Domain\Notes;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\Repository\ScheduleRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class ScheduleAddNoteService implements CommandHandler
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

    public function __invoke(ScheduleAddNoteCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if ($user->isPatient()) {
            throw new UserHasNotPermissionToAccess();
        }

        $schedule = $this->scheduleRepository->find($command->id());
        $schedule->addNote(
            Notes::build(
                new \DateTimeImmutable($command->date()),
                $command->text(),
                $user
            )
        );

        $this->scheduleRepository->update($schedule);
    }

    public function subscribedTo(): string
    {
        return ScheduleAddNoteCommand::class;
    }

    /**
     * @param ScheduleAddNoteCommand $command
     */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
