<?php

declare(strict_types=1);

namespace Mvc\Application\Query;

use Mvc\Infrastructure\CQRS\Query\Query;

class LoginPatientQuery implements Query
{
    /** @var string */
    private $cip;
    /** @var string */
    private $password;

    public function __construct(
        string $cip,
        string $password
    ) {
        $this->cip = $cip;
        $this->password = $password;
    }

    public function cip(): string
    {
        return $this->cip;
    }

    public function password(): string
    {
        return $this->password;
    }
}
