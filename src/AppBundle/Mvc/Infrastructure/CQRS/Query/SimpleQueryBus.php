<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Query;

final class SimpleQueryBus implements QueryBus
{
    /** @var iterable<QueryHandler> */
    private $handlers;

    /** @param iterable<QueryHandler> $handlers */
    public function __construct(iterable $handlers)
    {
        $this->handlers = $handlers;
    }

    public function ask(Query $query)
    {
        foreach ($this->handlers as $handler) {
            if ($handler->subscribedTo() === get_class($query)) {
                return $handler->handle($query);
            }
        }
        throw new QueryNotRegisteredException(['class' => get_class($query)]);
    }
}
