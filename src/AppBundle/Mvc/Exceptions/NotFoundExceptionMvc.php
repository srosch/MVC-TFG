<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Throwable;

abstract class NotFoundExceptionMvc extends ExceptionMvc
{
	public function __construct(string $message = "Not found", array $meta = [], Throwable $previous = null)
	{
		parent::__construct($message, 404, $previous, $meta);
	}
}
