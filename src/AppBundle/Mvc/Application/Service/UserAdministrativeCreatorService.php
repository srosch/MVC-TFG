<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\UserAdministrativeCreatorCommand;
use AppBundle\Mvc\Exceptions\UserAlreadyExistsException;
use Mvc\Domain\UserContactData;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\User;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserAdministrativeCreatorService implements CommandHandler
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

    public function __invoke(UserAdministrativeCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isAdministrative()) {
            throw new UserHasNotPermissionToAccess();
        }

        $userExist = $this->userRepository->searchByEmail($command->email());
        if (null !== $userExist) {
            throw new UserAlreadyExistsException(['email' => $command->email()]);
        }

        $user = User::createAdministrative(
            $command->id(),
            $command->name(),
            $command->password(),
            $command->firstLastName(),
            $command->secondLastName(),
            $command->email(),
            $command->nif(),
            UserContactData::build(
                $command->email(),
                $command->address(),
                $command->municipality(),
                $command->postalCode(),
                $command->telephone(),
                $command->mobilephone(),
                false
            )
        );
        $password = $this->userPasswordEncoder->encodePassword($user, $command->password());
        $user->setPassword($password);
        $this->userRepository->save($user);
    }

    public function subscribedTo(): string
    {
        return UserAdministrativeCreatorCommand::class;
    }

    /**
     * @param UserAdministrativeCreatorCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
