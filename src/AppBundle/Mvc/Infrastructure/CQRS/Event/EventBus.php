<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

use Throwable;

interface EventBus
{
    /** @throws Throwable */
    public function notify(Event ...$events): void;
}
