<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Event;

use AppBundle\Mvc\Exceptions\ConflictExceptionMvc;
use Throwable;

final class MessageNotFoundException extends ConflictExceptionMvc
{
    /** @var string */

    public function __construct(
        array $meta = [],
        Throwable $previous = null
    ) {
        parent::__construct(
            'Message not found',
            $meta,
            $previous
        );
    }
}
