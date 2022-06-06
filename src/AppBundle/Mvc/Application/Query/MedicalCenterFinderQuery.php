<?php

declare(strict_types=1);

namespace Mvc\Application\Query;

use Mvc\Infrastructure\CQRS\Query\Query;

class MedicalCenterFinderQuery implements Query
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;

    public function __construct(
        string $userId,
        string $id
    ) {
        $this->userId = $userId;
        $this->id = $id;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function id(): string
    {
        return $this->id;
    }
}
