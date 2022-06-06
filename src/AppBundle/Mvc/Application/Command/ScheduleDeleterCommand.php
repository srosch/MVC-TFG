<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class ScheduleDeleterCommand implements Command
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
