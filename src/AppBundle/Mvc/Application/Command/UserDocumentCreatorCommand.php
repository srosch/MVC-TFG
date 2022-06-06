<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class UserDocumentCreatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $notes;
    /** @var string */
    private $patient;
    /** @var string */
    private $date;
    /** @var string */
    private $type;
    /** @var string */
    private $base64;

    public function __construct(
        string $userId,
        string $id,
        string $patient,
        string $type,
        string $date,
        string $notes,
        string $base64,
        string $name
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->name = $name;
        $this->notes = $notes;
        $this->patient = $patient;
        $this->type = $type;
        $this->date = $date;
        $this->base64 = $base64;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function notes(): string
    {
        return $this->notes;
    }

    public function patient(): string
    {
        return $this->patient;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function base64(): string
    {
        return $this->base64;
    }
}
