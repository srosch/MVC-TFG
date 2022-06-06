<?php

declare(strict_types=1);

namespace Mvc\Application\Query;

use Mvc\Infrastructure\CQRS\Query\Query;

class AllergyFindersQuery implements Query
{
    /** @var string */
    private $userId;

    public function __construct(
        string $userId
    ) {
        $this->userId = $userId;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
