<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/** @MongoDB\Document(collection="DomainEvents") */
class DoctrineEvent
{
    /**
     * @MongoDB\Id(strategy="auto")
     * @var string $id
     */
    private $id;

    /**
     * @MongoDB\Field(type="integer")
     * @var int $occurredOn
     */
    private $occurredOn;

    /**
     * @MongoDB\Field(type="string")
     * @var string $name
     */
    private $name;

    /**
     * @MongoDB\Field(type="string")
     * @var string $data
     */
    private $data;

    public function __construct(string $id, int $occurredOn, string $name, string $data)
    {
        $this->id = $id;
        $this->occurredOn = $occurredOn;
        $this->name = $name;
        $this->data = $data;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function occurredOn(): int
    {
        return $this->occurredOn;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function data(): string
    {
        return $this->data;
    }
}
