<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\OnlineConsultationCreatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\OnlineConsultation;
use Mvc\Domain\Repository\OnlineConsultationRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class OnlineConsultationCreatorService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var OnlineConsultationRepository */
    private $onlineConsultationRepository;

    public function __construct(
        UserRepository $userRepository,
        OnlineConsultationRepository $onlineConsultationRepository
    ) {
        $this->userRepository = $userRepository;
        $this->onlineConsultationRepository = $onlineConsultationRepository;
    }

    public function __invoke(OnlineConsultationCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isPatient()) {
            throw new UserHasNotPermissionToAccess();
        }

        $onlineConsultation = OnlineConsultation::create(
            $command->id(),
            $user,
            new \DateTimeImmutable($command->date()),
            $command->text(),
            null
        );

        $this->onlineConsultationRepository->save($onlineConsultation);
    }

    public function subscribedTo(): string
    {
        return OnlineConsultationCreatorCommand::class;
    }

    /**
     * @param OnlineConsultationCreatorCommand $command
     */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
