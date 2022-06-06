<?php

declare(strict_types=1);

namespace Mvc\Application\Query;

use Mvc\Infrastructure\CQRS\Query\Query;

class LoginHealthPersonnelQuery implements Query
{
    /** @var string */
    private $nif;
    /** @var string */
    private $password;

    public function __construct(
        string $nif,
        string $password
    ) {
        $this->nif = $nif;
        $this->password = $password;
    }

    public function nif(): string
    {
        return $this->nif;
    }

    public function password(): string
    {
        return $this->password;
    }
}
