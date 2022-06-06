<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\OnlineConsultationResponseCommand;
use Mvc\Notifier\UserMailSender;
use Mvc\Notifier\UserMailSenderInterface;
use Mvc\Domain\ResponseOnlineConsultation;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\Repository\OnlineConsultationRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class OnlineConsultationResponseService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var OnlineConsultationRepository */
    private $onlineConsultationRepository;
    /** @var UserMailSenderInterface */
    private $userMailSender;

    public function __construct(
        UserRepository $userRepository,
        OnlineConsultationRepository $onlineConsultationRepository,
        UserMailSenderInterface $userMailSender
    ) {
        $this->userRepository = $userRepository;
        $this->onlineConsultationRepository = $onlineConsultationRepository;
        $this->userMailSender = $userMailSender;
    }

    public function __invoke(OnlineConsultationResponseCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $onlineConsultation = $this->onlineConsultationRepository->find($command->onlineConsultationId());
        $onlineConsultation->setResponse(
            ResponseOnlineConsultation::build(
                new \DateTimeImmutable($command->date(), null),
                $command->text(),
                $user
            )
        );
        $this->onlineConsultationRepository->update($onlineConsultation);

        if ($onlineConsultation->getPatient()->getContact()->getNotifications()) {
            $this->userMailSender->sendEmailOnlineConsultation(
                $onlineConsultation->getPatient()->getContact()->getEmail(),
                $onlineConsultation->getPatient()->getName()
                . " " . $onlineConsultation->getPatient()->getFirstLastName()
            );
        }
    }

    public function subscribedTo(): string
    {
        return OnlineConsultationResponseCommand::class;
    }

    /**
     * @param OnlineConsultationResponseCommand $command
     */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
