<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Command;

final class SimpleCommandBus implements CommandBus
{
    /** @var iterable<CommandHandler> */
    private $handlers;

    /** @param iterable<CommandHandler> $handlers */
    public function __construct(iterable $handlers)
    {
        $this->handlers = $handlers;
    }

    public function dispatch(Command $command): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler->subscribedTo() === get_class($command)) {
                $handler->handle($command);
                return;
            }
        }
        throw new CommandNotRegisteredException(['class' => get_class($command)]);
    }
}
