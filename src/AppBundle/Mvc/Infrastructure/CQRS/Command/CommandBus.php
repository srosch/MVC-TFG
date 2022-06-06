<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Command;

use Throwable;

interface CommandBus
{
    /** @throws Throwable */
    public function dispatch(Command $command): void;
}
