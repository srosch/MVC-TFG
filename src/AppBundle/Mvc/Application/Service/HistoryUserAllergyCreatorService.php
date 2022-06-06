<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\HistoryUserAllergyCreatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use AppBundle\Mvc\Exceptions\UserNotValidException;
use Mvc\Domain\HistoryUserAllergy;
use Mvc\Domain\Repository\AllergyRepository;
use Mvc\Domain\Repository\HistoryUserAllergyRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandHandler;

class HistoryUserAllergyCreatorService implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var HistoryUserAllergyRepository */
    private $historyUserAllergyRepository;
    /** @var AllergyRepository */
    private $allergyRepository;
    public function __construct(
        UserRepository $userRepository,
        HistoryUserAllergyRepository $historyUserAllergyRepository,
        AllergyRepository $allergyRepository
    ) {
        $this->userRepository = $userRepository;
        $this->historyUserAllergyRepository = $historyUserAllergyRepository;
        $this->allergyRepository = $allergyRepository;
    }

    public function __invoke(HistoryUserAllergyCreatorCommand $command): void
    {
        $user = $this->userRepository->find($command->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }

        $allergy = $this->allergyRepository->find($command->allergy());
        $patient = $this->userRepository->find($command->patient());
        if (!$patient->isPatient()) {
            throw new UserNotValidException();
        }
        $history = new HistoryUserAllergy(
            $command->id(),
            $patient,
            $allergy,
            new \DateTimeImmutable($command->date()),
            $command->notes()
        );

        $this->historyUserAllergyRepository->save($history);
    }

    public function subscribedTo(): string
    {
        return HistoryUserAllergyCreatorCommand::class;
    }

    /**
     * @param HistoryUserAllergyCreatorCommand $command
    */
    public function handle(Command $command): void
    {
        $this->__invoke($command);
    }
}
