<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\UserPatientModifyPrimaryCenterCommand;
use AppBundle\Mvc\Exceptions\UserNotValidException;
use Mvc\Domain\UserPrimaryCenter;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\Repository\MedicalCenterRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class UserPatientModifyPrimaryCenterService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var MedicalCenterRepository */
    private $medicalCenterRepository;
    public function __construct(
        UserRepository $userRepository,
        MedicalCenterRepository $medicalCenterRepository
    ) {
        $this->userRepository = $userRepository;
        $this->medicalCenterRepository = $medicalCenterRepository;
    }

    public function __invoke(UserPatientModifyPrimaryCenterCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isAdministrative()) {
            throw new UserHasNotPermissionToAccess();
        }

        $patient = $this->userRepository->find($command->id());
        $doctor = $this->userRepository->find($command->doctor());
        $nurse = $this->userRepository->find($command->nurse());
        $medicalCenter = $this->medicalCenterRepository->find($command->medicalCenter());

        if (!$doctor->isHealthPersonnel() || !$nurse->isHealthPersonnel() || !$patient->isPatient()) {
            throw new UserNotValidException();
        }

        $patient->setPrimaryCenter(UserPrimaryCenter::build(
            $doctor,
            $nurse,
            $medicalCenter
        ));

        $this->userRepository->update($patient);
    }

    public function subscribedTo(): string
    {
        return UserPatientModifyPrimaryCenterCommand::class;
    }

    /**
     * @param UserPatientModifyPrimaryCenterCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
