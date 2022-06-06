<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class ScheduleUpdatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $date;

    public function __construct(
        string $userId,
        string $id,
        string $date
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->date = $date;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function date(): string
    {
        return $this->date;
    }
}
