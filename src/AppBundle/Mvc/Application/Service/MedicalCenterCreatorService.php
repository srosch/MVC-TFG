<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\MedicalCenterCreatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use AppBundle\Mvc\Exceptions\UserNotValidException;
use Mvc\Domain\MedicalCenter;
use Mvc\Domain\Repository\MedicalCenterRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class MedicalCenterCreatorService implements CommandHandler
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

    public function __invoke(MedicalCenterCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isAdministrative()) {
            throw new UserHasNotPermissionToAccess();
        }

        foreach ($command->healthPersonnel() as $healthPersonnel) {
            $h = $this->userRepository->find($healthPersonnel);
            if ($h->isPatient()) {
                throw new UserNotValidException();
            }
        }
        $medicalCenter = new MedicalCenter(
            $command->id(),
            $command->name(),
            $command->address(),
            $command->healthPersonnel()
        );

        $this->medicalCenterRepository->save($medicalCenter);
    }

    public function subscribedTo(): string
    {
        return MedicalCenterCreatorCommand::class;
    }

    /**
     * @param MedicalCenterCreatorCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
