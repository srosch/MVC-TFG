<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class VaccineCreatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $code;
    /** @var string */
    private $description;
    /** @var int[] */
    private $vaccinationPlantMonth;

    public function __construct(
        string $userId,
        string $id,
        string $name,
        string $code,
        string $description,
        array $vaccinationPlantMonth
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->description = $description;
        $this->vaccinationPlantMonth = $vaccinationPlantMonth;
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

    public function code(): string
    {
        return $this->code;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function vaccinationPlantMonth(): array
    {
        return $this->vaccinationPlantMonth;
    }
}
