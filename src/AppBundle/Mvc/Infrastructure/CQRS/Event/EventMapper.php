<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

abstract class EventMapper extends MessageMapper
{
    public function serviceName(): string
    {
        return 'mvc.mvc';
    }
}
