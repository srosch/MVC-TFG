<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

class UserHasNotPermissionToAccess extends ExceptionMvc
{
    public function __construct(array $meta = [], Throwable $previous = null)
    {
        parent::__construct(
            "The user does not have permission to access",
            401,
            $previous,
            $meta
        );
    }
}
