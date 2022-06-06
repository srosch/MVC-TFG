<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

abstract class Event extends Message
{
    public function __construct(array $attributes)
    {
        parent::__construct(
            'event',
            $attributes
        );
    }
}
