<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

abstract class UnauthorizedExceptionMvc extends ExceptionMvc
{
	public function __construct(string $message = "Unauthorized", array $meta = [], Throwable $previous = null)
	{
		parent::__construct($message, 401, $previous, $meta);
	}
}
