<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class ScheduleAddNoteCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $date;
    /** @var string */
    private $text;

    public function __construct(
        string $userId,
        string $id,
        string $date,
        string $text
    ) {
        $this->userId = $userId;
        $this->id = $id;
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

    public function date(): string
    {
        return $this->date;
    }

    public function text(): string
    {
        return $this->text;
    }
}
