<?php

namespace Mvc\Infrastructure\CQRS\Aggregates;

use Mvc\Infrastructure\CQRS\Event\Event;

abstract class AggregateRoot extends Aggregate
{
    /** @var Event[] */
    private $domainEvents = [];

    protected function record(Event $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }
    /** @return Event[] */
    public function pullEvents(): array
    {
        $domainEventsToReturn = $this->domainEvents;

        $this->domainEvents = [];

        return $domainEventsToReturn;
    }
}
