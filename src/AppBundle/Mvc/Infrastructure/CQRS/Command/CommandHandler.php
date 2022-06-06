<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Command;

use Throwable;

interface CommandHandler
{
    /** @throws Throwable */
    public function handle(Command $command): void;

    public function subscribedTo(): string;
}
