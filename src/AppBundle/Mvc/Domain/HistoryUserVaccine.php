<?php

declare(strict_types=1);

namespace Mvc\Domain;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;

/**
 * @MongoDB\Document(collection="HistoryUserVaccine")
 */
class HistoryUserVaccine extends AggregateRoot
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
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\Vaccine", simple=true)
     * @var Vaccine $vaccine
     */
    private $vaccine;
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
        Vaccine $vaccine,
        DateTimeImmutable $date,
        string $notes
    ) {
        $this->id = $id;
        $this->patient = $patient;
        $this->vaccine = $vaccine;
        $this->date = $date;
        $this->notes = $notes;
    }

    public static function create(
        string $id,
        User $patient,
        Vaccine $vaccine,
        DateTimeImmutable $date,
        string $notes
    ): self {
        return new self(
            $id,
            $patient,
            $vaccine,
            $date,
            $notes
        );
    }

    public function update(
        User $patient,
        Vaccine $vaccine,
        DateTimeImmutable $date,
        string $notes
    ): void {
        $this->patient = $patient;
        $this->vaccine = $vaccine;
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
    public function getVaccine(): Vaccine
    {
        return $this->vaccine;
    }
    public function getNotes(): string
    {
        return $this->notes;
    }
}
