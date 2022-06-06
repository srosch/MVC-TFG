<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions\Security;

use AppBundle\Exceptions\UnauthorizedExceptionMvc;
use Throwable;

class UnauthorizedCredentialsException extends UnauthorizedExceptionMvc
{
	public function __construct(Throwable $previous = null)
	{
		parent::__construct(
			"Unauthorized Credentials",
			[],
			$previous
		);
	}
}
