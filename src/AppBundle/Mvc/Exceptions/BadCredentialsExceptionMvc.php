<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

class BadCredentialsExceptionMvc extends UnauthorizedExceptionMvc
{
    public function __construct(array $meta = [], Throwable $previous = null)
    {
        parent::__construct(
            "Bad Credentials!",
            $meta
        );
    }
}
