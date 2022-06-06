<?php declare(strict_types=1);
namespace Mvc\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;


/**
 * @MongoDB\Document(collection="MedicalCenter")
 */
class MedicalCenter extends AggregateRoot
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
    private $address;
    /**
     * @MongoDB\Field(type="collection")
     * @var string[] $healthPersonnel
     */
    private $healthPersonnel;


    public function __construct(
        string $id,
        string $name,
        string $address,
        array $healthPersonnel
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->healthPersonnel = $healthPersonnel;
    }

    public static function create(
        string $id,
        string $name,
        string $address,
        array $healthPersonnel
    ): self {
        return new self(
            $id,
            $name,
            $address,
            $healthPersonnel
        );
    }

    public function update(
        string $name,
        string $address,
        array $healthPersonnel
    ): void {
        $this->name = $name;
        $this->address = $address;
        $this->healthPersonnel = $healthPersonnel;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    /** @return string[] */
    public function getHealthPersonnel(): array
    {
        return $this->healthPersonnel;
    }
}
