<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\UserPatientCreatorCommand;
use AppBundle\Mvc\Exceptions\UserAlreadyExistsException;
use Mvc\Domain\UserBirthData;
use Mvc\Domain\UserContactData;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\User;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserPatientCreatorService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var UserPasswordEncoderInterface */
    private $userPasswordEncoder;
    public function __construct(
        UserRepository $userRepository,
        UserPasswordEncoderInterface $userPasswordEncoder
    ) {
        $this->userRepository = $userRepository;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function __invoke(UserPatientCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if ($user->isPatient()) {
            throw new UserHasNotPermissionToAccess();
        }

        $userExist = $this->userRepository->searchByEmail($command->email());
        if (null !== $userExist) {
            throw new UserAlreadyExistsException(['email' => $command->email()]);
        }

        $user = User::createPatient(
            $command->id(),
            $command->name(),
            $command->password(),
            $command->firstLastName(),
            $command->secondLastName(),
            $command->email(),
            $command->nif(),
            $command->cip(),
            $command->bloodType(),
            $command->sex(),
            UserBirthData::build(
                new \DateTimeImmutable($command->birthDate(), null),
                $command->birthPlace(),
                $command->birthWeight(),
                $command->birthSize(),
                $command->birthNotes()
            ),
            UserContactData::build(
                $command->email(),
                $command->address(),
                $command->municipality(),
                $command->postalCode(),
                $command->telephone(),
                $command->mobilephone(),
                $command->notifications()
            )
        );
        $password = $this->userPasswordEncoder->encodePassword($user, $command->password());
        $user->setPassword($password);
        $this->userRepository->save($user);
    }

    public function subscribedTo(): string
    {
        return UserPatientCreatorCommand::class;
    }

    /**
     * @param UserPatientCreatorCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
