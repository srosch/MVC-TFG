<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Query;

use Throwable;

interface QueryBus
{
    /**
     * @throws Throwable
     * @return mixed
     */
    public function ask(Query $query);
}
