<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;


use AppBundle\Mvc\Exceptions\ConflictExceptionMvc;
use Throwable;

final class EventNotPublishedException extends ConflictExceptionMvc
{
    public function __construct(
        array $meta = [],
        Throwable $previous = null
    ) {
        parent::__construct(
            'Event not published',
            $meta,
            $previous
        );
    }
}
