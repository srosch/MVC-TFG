<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\UserDocumentCreatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\Repository\UserDocumentRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\UserDocument;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;
use Mvc\Notifier\UserMailSenderInterface;

class UserDocumentCreatorService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var UserDocumentRepository */
    private $userDocumentRepository;
    /** @var UserMailSenderInterface */
    private $userMailSender;

    public function __construct(
        UserRepository $userRepository,
        UserDocumentRepository $userDocumentRepository,
        UserMailSenderInterface $userMailSender

    ) {
        $this->userRepository = $userRepository;
        $this->userDocumentRepository = $userDocumentRepository;
        $this->userMailSender = $userMailSender;
    }

    public function __invoke(UserDocumentCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $patient = $this->userRepository->find($command->patient());
        $document = UserDocument::create(
            $command->id(),
            $patient,
            $command->type(),
            new \DateTimeImmutable($command->date()),
            $command->notes(),
            $command->base64(),
            $command->name()
        );
        $this->userDocumentRepository->save($document);

        if ($patient->getContact()->getNotifications()) {
            $this->userMailSender->sendEmailAddDocument(
                $patient->getContact()->getEmail(),
                $patient->getName() . " " . $patient->getFirstLastName()
            );
        }
    }

    public function subscribedTo(): string
    {
        return UserDocumentCreatorCommand::class;
    }

    /**
     * @param UserDocumentCreatorCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
