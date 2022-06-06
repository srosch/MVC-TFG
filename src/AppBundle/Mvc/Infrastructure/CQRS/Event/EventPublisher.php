<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

use Throwable;

interface EventPublisher
{
    /** @throws Throwable */
    public function publish(Event ...$events): void;
}
