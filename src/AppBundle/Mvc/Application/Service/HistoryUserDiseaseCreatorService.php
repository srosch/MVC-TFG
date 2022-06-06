<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\HistoryUserDiseaseCreatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\HistoryUserDisease;
use Mvc\Domain\Repository\DiseaseRepository;
use Mvc\Domain\Repository\HistoryUserDiseaseRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class HistoryUserDiseaseCreatorService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var HistoryUserDiseaseRepository */
    private $historyUserDiseaseRepository;
    /** @var DiseaseRepository */
    private $diseaseRepository;
    public function __construct(
        UserRepository $userRepository,
        HistoryUserDiseaseRepository $historyUserDiseaseRepository,
        DiseaseRepository $diseaseRepository
    ) {
        $this->userRepository = $userRepository;
        $this->historyUserDiseaseRepository = $historyUserDiseaseRepository;
        $this->diseaseRepository = $diseaseRepository;
    }

    public function __invoke(HistoryUserDiseaseCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $disease = $this->diseaseRepository->find($command->disease());
        $patient = $this->userRepository->find($command->patient());
        $history = new HistoryUserDisease(
            $command->id(),
            $patient,
            $disease,
            new \DateTimeImmutable($command->initDate()),
            null,
            $command->notes()
        );

        $this->historyUserDiseaseRepository->save($history);
    }

    public function subscribedTo(): string
    {
        return HistoryUserDiseaseCreatorCommand::class;
    }

    /**
     * @param HistoryUserDiseaseCreatorCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
