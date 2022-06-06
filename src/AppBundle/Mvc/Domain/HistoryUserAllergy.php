<?php

declare(strict_types=1);

namespace Mvc\Domain;

use DateTimeImmutable;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;

/**
 * @MongoDB\Document(collection="HistoryUserAllergy")
 */
class HistoryUserAllergy extends AggregateRoot
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
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\Allergy", simple=true)
     * @var Allergy $allergy
     */
    private $allergy;
    /**
     * @MongoDB\Field(type="date")
     */
    private $date;
    /**
     * @MongoDB\Field(type="string")
     */
    private $notes;

    public function __construct(
        string $id,
        User $patient,
        Allergy $allergy,
        DateTimeImmutable $date,
        string $notes
    ) {
        $this->id = $id;
        $this->patient = $patient;
        $this->allergy = $allergy;
        $this->date = $date;
        $this->notes = $notes;
    }

    public static function create(
        string $id,
        User $patient,
        Allergy $allergy,
        DateTimeImmutable $date,
        string $notes
    ): self {
        return new self(
            $id,
            $patient,
            $allergy,
            $date,
            $notes
        );
    }

    public function update(
        User $patient,
        Allergy $allergy,
        DateTimeImmutable $date,
        string $notes
    ): void {
        $this->patient = $patient;
        $this->allergy = $allergy;
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
    public function getAllergy(): Allergy
    {
        return $this->allergy;
    }
    public function getNotes(): string
    {
        return $this->notes;
    }
}
