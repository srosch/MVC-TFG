<?php

declare(strict_types=1);

namespace Mvc\Application\Query;

use Mvc\Infrastructure\CQRS\Query\Query;

class SchedulePatientFindersQuery implements Query
{
    /** @var string */
    private $userId;

    /** @var string */
    private $patient;

    public function __construct(
        string $userId,
        string $patient
    ) {
        $this->userId = $userId;
        $this->patient = $patient;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function patient(): string
    {
        return $this->patient;
    }
}
