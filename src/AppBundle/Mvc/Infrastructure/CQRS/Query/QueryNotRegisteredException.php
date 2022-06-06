<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Query;

use AppBundle\Mvc\Exceptions\NotFoundExceptionMvc;
use Throwable;

final class QueryNotRegisteredException extends NotFoundExceptionMvc
{
    public function __construct(
        array $meta = [],
        Throwable $previous = null
    ) {
        parent::__construct('Query not registered', $meta, $previous);
    }
}
