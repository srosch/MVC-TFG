<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions\Security;

use AppBundle\Exceptions\ForbiddenExceptionMvc;
use Throwable;

class AccessDeniedException extends ForbiddenExceptionMvc
{
	public function __construct(array $meta, Throwable $previous = null)
	{
		parent::__construct(
			'Access Denied. you don\'t have permission set',
			$meta,
			$previous
		);
	}
}
