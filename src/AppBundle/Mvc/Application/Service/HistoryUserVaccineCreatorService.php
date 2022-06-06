<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\HistoryUserVaccineCreatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\HistoryUserVaccine;
use Mvc\Domain\Repository\HistoryUserVaccineRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\Repository\VaccineRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class HistoryUserVaccineCreatorService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var HistoryUserVaccineRepository */
    private $historyUserVaccineRepository;
    /** @var VaccineRepository */
    private $vaccineRepository;
    public function __construct(
        UserRepository $userRepository,
        HistoryUserVaccineRepository $historyUserVaccineRepository,
        VaccineRepository $vaccineRepository
    ) {
        $this->userRepository = $userRepository;
        $this->historyUserVaccineRepository = $historyUserVaccineRepository;
        $this->vaccineRepository = $vaccineRepository;
    }

    public function __invoke(HistoryUserVaccineCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $vaccine = $this->vaccineRepository->find($command->vaccine());
        $patient = $this->userRepository->find($command->patient());
        $history = new HistoryUserVaccine(
            $command->id(),
            $patient,
            $vaccine,
            new \DateTimeImmutable($command->date()),
            $command->notes()
        );

        $this->historyUserVaccineRepository->save($history);
    }

    public function subscribedTo(): string
    {
        return HistoryUserVaccineCreatorCommand::class;
    }

    /**
     * @param HistoryUserVaccineCreatorCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
