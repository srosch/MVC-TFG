<?php

declare(strict_types=1);

namespace Mvc\Shared;

use Mvc\Infrastructure\CQRS\Event\Event;
use Mvc\Infrastructure\CQRS\Event\EventBus;

final class StaticEventBus implements EventBus
{
    /** @var null|StaticEventBus */
    private static $instance = null;
    /** @var EventBus */
    private $eventBus;

    private function __construct(EventBus $eventPublisher)
    {
        $this->eventBus = $eventPublisher;
    }

    public static function instance(?EventBus $eventBus = null): self
    {
        if (self::$instance !== null) {
            return self::$instance;
        }
        if ($eventBus === null) {
            throw new \LogicException('EventBus needed');
        }
        return (self::$instance = new self($eventBus));
    }

    public function notify(Event ...$events): void
    {
        $this->eventBus->notify(...$events);
    }
}
