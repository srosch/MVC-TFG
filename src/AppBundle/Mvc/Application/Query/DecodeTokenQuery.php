<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Query;

use Mvc\Infrastructure\CQRS\Query\Query;

class DecodeTokenQuery implements Query
{
    /** @var string */
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function token(): string
    {
        return $this->token;
    }
}
