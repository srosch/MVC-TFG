<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use Symfony\Component\HttpFoundation\Request;
use Throwable;
use Mvc\Infrastructure\CQRS\Command\Command;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\Query;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\Validator;

abstract class BaseController
{
    /** @var QueryBus */
    private $queryBus;
    /** @var CommandBus */
    private $commandBus;
    /** @var Validator */
    private $validator;

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        Validator $validator
    ) {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
        $this->validator = $validator;
    }
    /** @throws Throwable */
    protected function validate(Request $request): void
    {
        $this->validator->__invoke($request);
    }
    /**
     * @return mixed
     * @throws Throwable
     */
    protected function ask(Query $query)
    {
        return $this->queryBus->ask($query);
    }
    /** @throws Throwable */
    protected function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
