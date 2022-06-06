<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class DiseaseUpdatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $description;

    public function __construct(
        string $userId,
        string $id,
        string $name,
        string $description
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
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

    public function description(): string
    {
        return $this->description;
    }
}
