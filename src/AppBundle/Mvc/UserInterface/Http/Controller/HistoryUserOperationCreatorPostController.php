<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\HistoryUserOperationCreatorCommand;
use AppBundle\Mvc\Application\General\IdGenerator;
use Mvc\Application\Query\HistoryUserOperationsPatientFindersQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\HistoryUserOperationCreatorPostValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/history-operations", methods={"POST"}) */
final class HistoryUserOperationCreatorPostController extends BaseController
{
    /** @var IdGenerator */
    private $idGenerator;

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        HistoryUserOperationCreatorPostValidator $validator,
        IdGenerator $idGenerator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
        $this->idGenerator = $idGenerator;
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $id = $this->idGenerator->next();
        $body = $request->request->all();
        $this->dispatch(new HistoryUserOperationCreatorCommand(
            $userId,
            $id,
            $body['patient'],
            $body['date'],
            $body['notes']
        ));
        $res = $this->ask(new HistoryUserOperationsPatientFindersQuery($userId, $body['patient']));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }
}
