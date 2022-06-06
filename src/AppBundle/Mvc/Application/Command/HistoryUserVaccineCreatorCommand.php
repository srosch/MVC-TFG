<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class HistoryUserVaccineCreatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $patient;
    /** @var string */
    private $vaccine;
    /** @var string */
    private $date;
    /** @var string */
    private $notes;

    public function __construct(
        string $userId,
        string $id,
        string $patient,
        string $vaccine,
        string $date,
        string $notes
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->patient = $patient;
        $this->date = $date;
        $this->vaccine = $vaccine;
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

    public function vaccine(): string
    {
        return $this->vaccine;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function notes(): string
    {
        return $this->notes;
    }
}
