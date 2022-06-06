<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

abstract class BadRequestExceptionMvc extends ExceptionMvc
{
	public function __construct(string $message = "Bad request", array $meta = [], Throwable $previous = null)
	{
		parent::__construct($message, 400, $previous, $meta);
	}
}
