<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\CQRS\Query;

use Throwable;

interface QueryHandler
{
    /**
     * @return mixed
     * @throws Throwable
     */
    public function handle(Query $query);

    public function subscribedTo(): string;
}
