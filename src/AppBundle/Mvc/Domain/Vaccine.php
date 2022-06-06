<?php declare(strict_types=1);
namespace Mvc\Domain;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;


/**
 * @MongoDB\Document(collection="Vaccine")
 */
class Vaccine extends AggregateRoot
{
    /**
     * @MongoDB\Id(strategy="auto")
     * @var string $id
     */
    private $id;
    /**
     * @MongoDB\Field(type="string")
     */
    private $name;
    /**
     * @MongoDB\Field(type="string")
     */
    private $code;
    /**
     * @MongoDB\Field(type="string")
     */
    private $description;
    /**
     * @MongoDB\Field(type="hash")
     * @var int[]
     */
    private $vaccinationPlanMonth;


    public function __construct(
        string $id,
        string $name,
        string $code,
        string $description,
        array $vaccinationPlantMonth
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->description = $description;
        $this->vaccinationPlanMonth = $vaccinationPlantMonth;
    }

    public static function create(
        string $id,
        string $name,
        string $code,
        string $description,
        array $vaccinationPlantMonth
    ): self {
        return new self(
            $id,
            $name,
            $code,
            $description,
            $vaccinationPlantMonth
        );
    }

    public function update(
        string $name,
        string $code,
        string $description,
        array $vaccinationPlantMonth
    ): void {
        $this->name = $name;
        $this->code = $code;
        $this->description = $description;
        $this->vaccinationPlanMonth = $vaccinationPlantMonth;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getVaccinationPlanMonth(): array
    {
        return $this->vaccinationPlanMonth;
    }
}
