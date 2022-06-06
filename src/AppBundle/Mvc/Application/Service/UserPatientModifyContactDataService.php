<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\UserPatientModifyContactDataCommand;
use Mvc\Domain\UserContactData;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class UserPatientModifyContactDataService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserPatientModifyContactDataCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isAdministrative()) {
            throw new UserHasNotPermissionToAccess();
        }

        $patient = $this->userRepository->find($command->id());

        $patient->setEmail($command->email());
        $patient->setContactData(UserContactData::build(
            $command->email(),
            $command->address(),
            $command->municipality(),
            $command->postalCode(),
            $command->telephone(),
            $command->mobilephone(),
            $command->notifications()
        ));

        $this->userRepository->update($patient);
    }

    public function subscribedTo(): string
    {
        return UserPatientModifyContactDataCommand::class;
    }

    /**
     * @param UserPatientModifyContactDataCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
