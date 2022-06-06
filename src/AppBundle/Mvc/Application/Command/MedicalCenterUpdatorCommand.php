<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class MedicalCenterUpdatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $address;
    /** @var string[] */
    private $healthPersonnel;

    public function __construct(
        string $userId,
        string $id,
        string $name,
        string $address,
        array $healthPersonnel
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->healthPersonnel = $healthPersonnel;
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

    public function address(): string
    {
        return $this->address;
    }

    public function healthPersonnel(): array
    {
        return $this->healthPersonnel;
    }
}
