<?php

declare(strict_types=1);

namespace Mvc\Application\Query;

use Mvc\Infrastructure\CQRS\Query\Query;

class HelloWorldQuery implements Query
{
    public function __construct()
    {
    }
}
