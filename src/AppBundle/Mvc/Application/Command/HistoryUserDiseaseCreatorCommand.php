<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class HistoryUserDiseaseCreatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $patient;
    /** @var string */
    private $disease;
    /** @var string */
    private $initDate;
    /** @var string */
    private $notes;

    public function __construct(
        string $userId,
        string $id,
        string $patient,
        string $disease,
        string $initDate,
        string $notes
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->patient = $patient;
        $this->disease = $disease;
        $this->initDate = $initDate;
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

    public function patient(): string
    {
        return $this->patient;
    }

    public function disease(): string
    {
        return $this->disease;
    }

    public function initDate(): string
    {
        return $this->initDate;
    }

    public function notes(): string
    {
        return $this->notes;
    }
}
