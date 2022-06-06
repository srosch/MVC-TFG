<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

use DateTimeImmutable;
use MongoDB\BSON\ObjectId;

abstract class Message
{
    /** @var array */
    private $meta;
    /** @var array */
    protected $attributes;

    public function __construct(
        string $type,
        array $attributes
    ) {
        $this->meta = [
            'id' => (string)new ObjectId(),
            'type' => $type,
            'occurredOn' => (new DateTimeImmutable())->getTimestamp(),
        ];
        $this->attributes = $attributes;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getMeta(): array
    {
        return $this->meta;
    }
}
