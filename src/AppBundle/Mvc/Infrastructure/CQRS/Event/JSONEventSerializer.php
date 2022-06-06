<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

class JSONEventSerializer extends JSONMessageSerializer
{
    protected function matchType(): string
    {
        return 'event';
    }
}
