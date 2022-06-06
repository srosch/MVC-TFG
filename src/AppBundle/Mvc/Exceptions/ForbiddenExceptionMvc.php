<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

abstract class ForbiddenExceptionMvc extends ExceptionMvc
{
	public function __construct(string $message = "Forbidden", array $meta = [], Throwable $previous = null)
	{
		parent::__construct($message, 403, $previous, $meta);
	}
}
