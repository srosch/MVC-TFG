<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class ScheduleCreatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $patient;
    /** @var string */
    private $center;
    /** @var string */
    private $healthPersonnel;
    /** @var string */
    private $date;
    /** @var string */
    private $text;

    public function __construct(
        string $userId,
        string $id,
        string $patient,
        string $center,
        string $healthPersonnel,
        string $date,
        string $text
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->patient = $patient;
        $this->center = $center;
        $this->healthPersonnel = $healthPersonnel;
        $this->date = $date;
        $this->text = $text;
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

    public function center(): string
    {
        return $this->center;
    }

    public function healthPersonnel(): string
    {
        return $this->healthPersonnel;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function text(): string
    {
        return $this->text;
    }
}
