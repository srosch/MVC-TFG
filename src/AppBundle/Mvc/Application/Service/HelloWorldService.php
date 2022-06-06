<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use Mvc\Application\Query\HelloWorldQuery;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class HelloWorldService implements QueryHandler
{
    public function __construct()
    {
    }


    public function __invoke(HelloWorldQuery $query): string
    {

        return 'Hello World';
    }

    public function subscribedTo(): string
    {
        return HelloWorldQuery::class;
    }

    /**
     * @param HelloWorldQuery $query
    */
    public function handle(Query $query): string
    {
        return $this->__invoke($query);
    }
}
