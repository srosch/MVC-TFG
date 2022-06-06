<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\HistoryUserOperationsAddNoteCommand;
use Mvc\Domain\Notes;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\Repository\HistoryUserOperationsRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class HistoryUserOperationsAddNoteService implements CommandHandler
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

    public function __invoke(HistoryUserOperationsAddNoteCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if ($user->isPatient()) {
            throw new UserHasNotPermissionToAccess();
        }

        $history = $this->historyUserOperationsRepository->find($command->id());
        $history->addNote(
            Notes::build(
                new \DateTimeImmutable($command->date()),
                $command->text(),
                $user
            )
        );

        $this->historyUserOperationsRepository->update($history);
    }

    public function subscribedTo(): string
    {
        return HistoryUserOperationsAddNoteCommand::class;
    }

    /**
     * @param HistoryUserOperationsAddNoteCommand $command
     */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
