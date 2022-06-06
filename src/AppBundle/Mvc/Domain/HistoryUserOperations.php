<?php

declare(strict_types=1);

namespace Mvc\Domain;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;

/**
 * @MongoDB\Document(collection="HistoryUserOperations")
 */
class HistoryUserOperations extends AggregateRoot
{
    /**
     * @MongoDB\Id(strategy="auto")
     * @var string $id
     */
    private $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\User", simple=true)
     * @var User $patient
     */
    private $patient;
    /**
     * @MongoDB\Field(type="date")
     */
    private $date;
    /**
     * @MongoDB\EmbedMany(targetDocument="Mvc\Domain\Notes")
     * @var Notes[] $notes
     */
    private $notes;

    public function __construct(
        string $id,
        User $patient,
        DateTimeImmutable $date,
        array $notes
    ) {
        $this->id = $id;
        $this->patient = $patient;
        $this->date = $date;
        $this->notes = $notes;
    }

    public static function create(
        string $id,
        User $patient,
        DateTimeImmutable $date,
        array $notes
    ): self {
        return new self(
            $id,
            $patient,
            $date,
            $notes
        );
    }

    public function update(
        User $patient,
        DateTimeImmutable $date,
        array $notes
    ): void {
        $this->patient = $patient;
        $this->date = $date;
        $this->notes = $notes;
    }

    public function getId(): string
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
    public function getPatient(): User
    {
        return $this->patient;
    }
    /** @return Notes[] */
    public function getNotes(): array
    {
        return $this->notes->getValues();
    }

    public function addNote(Notes $note): void
    {
        $this->notes = array_merge($this->getNotes(), [$note]);
    }
}
