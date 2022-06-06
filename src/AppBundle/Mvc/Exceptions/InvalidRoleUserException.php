<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

class InvalidRoleUserException extends ExceptionMvc
{
    public function __construct(array $meta = [], Throwable $previous = null)
    {
        parent::__construct(
            "Invalid Role User",
            400,
            $previous,
            $meta
        );
    }
}
