<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\HistoryUserDonationsCreatorCommand;
use Mvc\Domain\DonationType;
use AppBundle\Mvc\Exceptions\InvalidDonationTypeException;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Domain\HistoryUserDonations;
use Mvc\Domain\Repository\HistoryUserDonationsRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class HistoryUserDonationCreatorService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var HistoryUserDonationsRepository */
    private $historyUserDonationsRepository;

    public function __construct(
        UserRepository $userRepository,
        HistoryUserDonationsRepository $historyUserDonationsRepository
    ) {
        $this->userRepository = $userRepository;
        $this->historyUserDonationsRepository = $historyUserDonationsRepository;
    }

    public function __invoke(HistoryUserDonationsCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $patient = $this->userRepository->find($command->patient());
        $history = HistoryUserDonations::create(
            $command->id(),
            $patient,
            new DonationType($command->type()),
            new \DateTimeImmutable($command->date()),
            $command->notes()
        );

        $this->historyUserDonationsRepository->save($history);
    }

    public function subscribedTo(): string
    {
        return HistoryUserDonationsCreatorCommand::class;
    }

    /**
     * @param HistoryUserDonationsCreatorCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
