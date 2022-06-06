<?php

declare(strict_types=1);

namespace Mvc\Domain;

use DateTimeImmutable;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class UserBirthData
{
    /**
     * @MongoDB\Field(type="date")
     */
    private $date;
    /**
     * @MongoDB\Field(type="string")
     * @var string $place
     */
    private $place;
    /**
     * @MongoDB\Field(type="float")
     * @var float|null $weight
     */
    private $weight;
    /**
     * @MongoDB\Field(type="float")
     * @var float|null $size
     */
    private $size;
    /**
     * @MongoDB\Field(type="string")
     * @var string $notes
     */
    private $notes;

    public static function build(
        DateTimeImmutable $date,
        string $place,
        float $weight,
        float $size,
        string $notes
    ): self {
        $entity = new self();
        $entity->setDate($date);
        $entity->setPlace($place);
        $entity->setWeight($weight);
        $entity->setSize($size);
        $entity->setNotes($notes);
        return $entity;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * @param \MongoDate $lastUpdate
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }
    public function getPlace(): string
    {
        return $this->place;
    }
    public function setPlace(string $place): void
    {
        $this->place = $place;
    }
    public function getWeight(): float
    {
        return $this->weight;
    }
    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }
    public function getSize(): float
    {
        return $this->size;
    }
    public function setSize(float $size): void
    {
        $this->size = $size;
    }
    public function getNotes(): string
    {
        return $this->notes;
    }
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }
}
