<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

class UserNotValidException extends ExceptionMvc
{
    public function __construct(array $meta = [], Throwable $previous = null)
    {
        parent::__construct(
            "Health personnel or patient is not valid!",
            404,
            $previous,
            $meta
        );
    }
}
