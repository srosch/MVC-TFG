<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class UserPatientModifyPrimaryCenterCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $doctor;
    /** @var string */
    private $nurse;
    /** @var string */
    private $medicalCenter;

    public function __construct(
        string $userId,
        string $id,
        string $doctor,
        string $nurse,
        string $medicalCenter
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->doctor = $doctor;
        $this->nurse = $nurse;
        $this->medicalCenter = $medicalCenter;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function doctor(): string
    {
        return $this->doctor;
    }

    public function nurse(): string
    {
        return $this->nurse;
    }

    public function medicalCenter(): string
    {
        return $this->medicalCenter;
    }
}
