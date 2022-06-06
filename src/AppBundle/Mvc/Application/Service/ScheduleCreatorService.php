<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\ScheduleCreatorCommand;
use Mvc\Domain\Notes;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\Repository\MedicalCenterRepository;
use Mvc\Domain\Repository\ScheduleRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\Schedule;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class ScheduleCreatorService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var ScheduleRepository */
    private $scheduleRepository;
    /** @var MedicalCenterRepository */
    private $medicalCenterRepository;

    public function __construct(
        UserRepository $userRepository,
        ScheduleRepository $scheduleRepository,
        MedicalCenterRepository $medicalCenterRepository
    ) {
        $this->userRepository = $userRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->medicalCenterRepository = $medicalCenterRepository;
    }

    public function __invoke(ScheduleCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isAdministrative()) {
            throw new UserHasNotPermissionToAccess();
        }

        $patient = $this->userRepository->find($command->patient());
        $healthPersonnel = $this->userRepository->find($command->healthPersonnel());
        $center = $this->medicalCenterRepository->find($command->center());


        $schedule = Schedule::create(
            $command->id(),
            $patient,
            $healthPersonnel,
            $center,
            new \DateTimeImmutable($command->date()),
            [
              Notes::build(
                  new \DateTimeImmutable($command->date()),
                  $command->text(),
                  $healthPersonnel
              )
            ]
        );
        $this->scheduleRepository->save($schedule);
    }

    public function subscribedTo(): string
    {
        return ScheduleCreatorCommand::class;
    }

    /**
     * @param ScheduleCreatorCommand $command
     */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
