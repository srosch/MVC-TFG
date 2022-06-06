<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

abstract class ConflictExceptionMvc extends ExceptionMvc
{
	public function __construct(string $message = "Conflict", array $meta = [], Throwable $previous = null)
	{
		parent::__construct($message, 409, $previous, $meta);
	}
}
