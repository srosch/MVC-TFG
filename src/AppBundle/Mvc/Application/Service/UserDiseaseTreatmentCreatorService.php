<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\UserDiseaseTreatmentCreatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use DateTimeImmutable;
use Mvc\Domain\Repository\HistoryUserDiseaseRepository;
use Mvc\Domain\Repository\UserDiseaseTreatmentRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\UserDiseaseTreatment;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class UserDiseaseTreatmentCreatorService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var UserDiseaseTreatmentRepository */
    private $userDiseaseTreatmentRepository;
    /** @var HistoryUserDiseaseRepository */
    private $historyUserDiseaseRepository;
    public function __construct(
        UserRepository $userRepository,
        UserDiseaseTreatmentRepository $userDiseaseTreatmentRepository,
        HistoryUserDiseaseRepository $historyUserDiseaseRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userDiseaseTreatmentRepository = $userDiseaseTreatmentRepository;
        $this->historyUserDiseaseRepository = $historyUserDiseaseRepository;
    }

    public function __invoke(UserDiseaseTreatmentCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $historyDisease = $this->historyUserDiseaseRepository->find($command->historyUserDisease());

        $treatment = UserDiseaseTreatment::create(
            $command->id(),
            $historyDisease->getId(),
            new DateTimeImmutable($command->initDate()),
            ($command->endDate() == null) ? null : new DateTimeImmutable($command->endDate()),
            $command->notes()
        );

        $this->userDiseaseTreatmentRepository->save($treatment);
    }

    public function subscribedTo(): string
    {
        return UserDiseaseTreatmentCreatorCommand::class;
    }

    /**
     * @param UserDiseaseTreatmentCreatorCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
