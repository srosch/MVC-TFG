<?php

declare(strict_types=1);

namespace Mvc\Domain;

use DateTimeImmutable;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Mvc\Infrastructure\CQRS\Aggregates\AggregateRoot;

/**
 * @MongoDB\Document(collection="UserDocument")
 */
class UserDocument extends AggregateRoot
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
     * @MongoDB\Field(type="string")
     */
    private $type;
    /**
     * @MongoDB\Field(type="date")
     */
    private $date;
    /**
     * @MongoDB\Field(type="string")
     */
    private $notes;
    /**
     * @MongoDB\Field(type="string")
     */
    private $base64;
    /**
     * @MongoDB\Field(type="string")
     */
    private $name;

    public function __construct(
        string $id,
        User $patient,
        string $type,
        DateTimeImmutable $date,
        string $notes,
        string $base64,
        string $name
    ) {
        $this->id = $id;
        $this->patient = $patient;
        $this->type = $type;
        $this->date = $date;
        $this->notes = $notes;
        $this->base64 = $base64;
        $this->name = $name;
    }

    public static function create(
        string $id,
        User $patient,
        string $type,
        DateTimeImmutable $date,
        string $notes,
        string $base64,
        string $name
    ): self {
        return new self(
            $id,
            $patient,
            $type,
            $date,
            $notes,
            $base64,
            $name
        );
    }

    public function update(
        User $patient,
        string $type,
        DateTimeImmutable $date,
        string $notes,
        string $base64,
        string $name
    ): void {
        $this->patient = $patient;
        $this->type = $type;
        $this->date = $date;
        $this->notes = $notes;
        $this->base64 = $base64;
        $this->name = $name;
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
    public function getType(): string
    {
        return $this->type;
    }
    public function getNotes(): string
    {
        return $this->notes;
    }
    public function getBase64(): string
    {
        return $this->base64;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
