<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

class UnauthorizedTokenException extends UnauthorizedExceptionMvc
{
    public function __construct(array $meta = [], Throwable $previous = null)
    {
        parent::__construct(
            "UnauthorizedTokenException!",
            $meta
        );
    }
}
