<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Exceptions;

use Exception;
use Throwable;

abstract class ExceptionMvc extends Exception
{
    /** @var array */
    private $meta;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null, array $meta = [])
    {
        parent::__construct(sprintf("%s [meta]: %s", $message, json_encode($meta)), $code, $previous);
        $this->meta = $meta;
    }

    public function meta(): array
    {
        return $this->meta;
    }
}