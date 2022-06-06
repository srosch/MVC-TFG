<?php declare(strict_types=1);
namespace Mvc\Domain;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;


/**
 * @MongoDB\Document(collection="Disease")
 */
class Disease extends AggregateRoot
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
    private $description;


    public function __construct(
        string $id,
        string $name,
        string $description
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public static function create(
        string $id,
        string $name,
        string $description
    ): self {
        return new self(
            $id,
            $name,
            $description
        );
    }

    public function update(
        string $name,
        string $description
    ): void {
       $this->name = $name;
       $this->description = $description;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
