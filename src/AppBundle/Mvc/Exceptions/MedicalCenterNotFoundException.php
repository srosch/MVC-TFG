<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

class MedicalCenterNotFoundException extends ExceptionMvc
{
    public function __construct(array $meta = [], Throwable $previous = null)
    {
        parent::__construct(
            "Medical Center not found!",
            404,
            $previous,
            $meta
        );
    }
}
