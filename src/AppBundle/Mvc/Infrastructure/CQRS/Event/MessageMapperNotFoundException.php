<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

use AppBundle\Mvc\Exceptions\ConflictExceptionMvc;
use Throwable;

final class MessageMapperNotFoundException extends ConflictExceptionMvc
{
    public function __construct(
        array $meta = [],
        Throwable $previous = null
    ) {
        parent::__construct(
            'MessageMapper not found',
            $meta,
            $previous
        );
    }
}
