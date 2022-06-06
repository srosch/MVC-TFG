<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

interface EventHandler
{
    public function __invoke(Event ...$events): void;

    /** @return string[] */
    public static function subscribedTo(): array;
}
