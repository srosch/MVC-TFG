<?php

declare(strict_types=1);

namespace Mvc\Domain;

use DateTimeImmutable;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;

/**
 * @MongoDB\Document(collection="HistoryUserDisease")
 */
class HistoryUserDisease extends AggregateRoot
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
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\Disease", simple=true)
     * @var Disease $disease
     */
    private $disease;
    /**
     * @MongoDB\Field(type="date")
     */
    private $initDate;
    /**
     * @MongoDB\Field(type="date")
     */
    private $endDate;
    /**
     * @MongoDB\Field(type="string")
     */
    private $notes;

    public function __construct(
        string $id,
        User $patient,
        Disease $disease,
        DateTimeImmutable $initDate,
        ?DateTimeImmutable $endDate,
        string $notes
    ) {
        $this->id = $id;
        $this->patient = $patient;
        $this->disease = $disease;
        $this->initDate = $initDate;
        $this->endDate = $endDate;
        $this->notes = $notes;
    }

    public static function create(
        string $id,
        User $patient,
        Disease $disease,
        DateTimeImmutable $initDate,
        ?DateTimeImmutable $endDate,
        string $notes
    ): self {
        return new self(
            $id,
            $patient,
            $disease,
            $initDate,
            $endDate,
            $notes
        );
    }

    public function update(
        User $patient,
        Disease $disease,
        DateTimeImmutable $initDate,
        ?DateTimeImmutable $endDate,
        string $notes
    ): void {
        $this->patient = $patient;
        $this->disease = $disease;
        $this->initDate = $initDate;
        $this->endDate = $endDate;
        $this->notes = $notes;
    }

    public function getId(): string
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getInitDate()
    {
        return $this->initDate;
    }
    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    public function getPatient(): User
    {
        return $this->patient;
    }
    public function getDisease(): Disease
    {
        return $this->disease;
    }
    public function getNotes(): string
    {
        return $this->notes;
    }
}
