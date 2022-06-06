<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

final class SimpleEventBus implements EventBus
{
    /** @var array */
    private $handlers;

    /** @param iterable<EventHandler> $handlers */
    public function __construct(iterable $handlers)
    {
        $this->handlers = [];
        foreach ($handlers as $handler) {
            foreach ($handler->subscribedTo() as $eventClass) {
                $this->handlers[$eventClass][] = $handler;
            }
        }
    }

    public function notify(Event ...$events): void
    {
        /**
         * @var string $eventClass
         * @var EventHandler[] $handler
         */
        foreach ($this->handlers as $eventClass => $handler) {
            foreach ($events as $event) {
                if (get_class($event) === $eventClass) {
                    foreach ($handler as $callable) {
                        $callable->__invoke($event);
                    }
                }
            }
        }
    }
}
