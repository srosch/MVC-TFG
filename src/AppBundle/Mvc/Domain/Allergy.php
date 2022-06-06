<?php declare(strict_types=1);
namespace Mvc\Domain;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;


/**
 * @MongoDB\Document(collection="Allergy")
 */
class Allergy extends AggregateRoot
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
    private $notes;


    public function __construct(
        string $id,
        string $name,
        string $notes
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->notes = $notes;
    }

    public static function create(
        string $id,
        string $name,
        string $notes
    ): self {
        return new self(
            $id,
            $name,
            $notes
        );
    }

    public function update(
        string $name,
        string $notes
    ): void {
       $this->name = $name;
       $this->notes = $notes;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }
}
