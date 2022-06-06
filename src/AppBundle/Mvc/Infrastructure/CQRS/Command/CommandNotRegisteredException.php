<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Command;

use AppBundle\Mvc\Exceptions\NotFoundExceptionMvc;
use Throwable;


final class CommandNotRegisteredException extends NotFoundExceptionMvc
{
    public function __construct(
        array $meta = [],
        Throwable $previous = null
    ) {
        parent::__construct(
            'Command not registered',
            $meta,
            $previous
        );
    }
}
