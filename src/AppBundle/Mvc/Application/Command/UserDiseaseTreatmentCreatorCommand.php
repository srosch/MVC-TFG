<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class UserDiseaseTreatmentCreatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $historyUserDisease;
    /** @var string */
    private $initDate;
    /** @var null|string */
    private $endDate;
    /** @var string */
    private $notes;

    public function __construct(
        string $userId,
        string $id,
        string $historyUserDisease,
        string $initDate,
        ?string $endDate,
        string $notes
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->historyUserDisease = $historyUserDisease;
        $this->initDate = $initDate;
        $this->endDate = $endDate;
        $this->notes = $notes;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function historyUserDisease(): string
    {
        return $this->historyUserDisease;
    }

    public function initDate(): string
    {
        return $this->initDate;
    }

    public function endDate(): ?string
    {
        return $this->endDate;
    }

    public function notes(): string
    {
        return $this->notes;
    }
}
