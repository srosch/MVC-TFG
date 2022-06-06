<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class AllergyCreatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $notes;

    public function __construct(
        string $userId,
        string $id,
        string $name,
        string $notes
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->name = $name;
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

    public function name(): string
    {
        return $this->name;
    }

    public function notes(): string
    {
        return $this->notes;
    }
}
