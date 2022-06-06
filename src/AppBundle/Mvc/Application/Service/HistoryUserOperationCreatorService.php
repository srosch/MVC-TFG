<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\HistoryUserDiseaseCreatorCommand;
use AppBundle\Mvc\Application\Command\HistoryUserOperationCreatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\HistoryUserDisease;
use Mvc\Domain\HistoryUserOperations;
use Mvc\Domain\Notes;
use Mvc\Domain\Repository\DiseaseRepository;
use Mvc\Domain\Repository\HistoryUserDiseaseRepository;
use Mvc\Domain\Repository\HistoryUserOperationsRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class HistoryUserOperationCreatorService implements CommandHandler
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

    public function __invoke(HistoryUserOperationCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $patient = $this->userRepository->find($command->patient());
        $history = new HistoryUserOperations(
            $command->id(),
            $patient,
            new \DateTimeImmutable($command->date()),
            [
                Notes::build(
                    new \DateTimeImmutable($command->date()),
                    $command->notes(),
                    $user
                )
            ]
        );

        $this->historyUserOperationsRepository->save($history);
    }

    public function subscribedTo(): string
    {
        return HistoryUserOperationCreatorCommand::class;
    }

    /**
     * @param HistoryUserOperationCreatorCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
