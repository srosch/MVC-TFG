<?php

declare(strict_types=1);

namespace Mvc\Domain;

use DateTimeImmutable;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Notes
{
    /**
     * @MongoDB\Field(type="date")
     */
    private $date;
    /**
     * @MongoDB\Field(type="string")
     * @var string $text
     */
    private $text;
    /**
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\User", simple=true)
     * @var User $healthPersonnel
     */
    private $healthPersonnel;

    public static function build(
        DateTimeImmutable $date,
        string $text,
        User $healthPersonnel
    ): self {
        $entity = new self();
        $entity->setDate($date);
        $entity->setText($text);
        $entity->setHealthPersonnel($healthPersonnel);
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
    public function getText(): string
    {
        return $this->text;
    }
    public function setText(string $text): void
    {
        $this->text = $text;
    }
    public function getHealthPersonnel(): User
    {
        return $this->healthPersonnel;
    }
    public function setHealthPersonnel(User $healthPersonnel): void
    {
        $this->healthPersonnel = $healthPersonnel;
    }
}
