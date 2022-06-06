<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Query;

use Mvc\Infrastructure\CQRS\Query\Query;

class EncodeTokenQuery implements Query
{
    /** @var string */
    private $email;
    /** @var string */
    private $password;

    public function __construct(
        string $email,
        string $password
    ) {
        $this->email = $email;
        $this->password = $password;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
