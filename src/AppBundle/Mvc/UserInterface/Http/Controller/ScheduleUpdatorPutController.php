<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\ScheduleUpdatorCommand;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\ScheduleUpdatorPutValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/schedule/{scheduleId}", methods={"PUT"}) */
final class ScheduleUpdatorPutController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        ScheduleUpdatorPutValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $id = $request->attributes->get('scheduleId');
        $body = $request->request->all();
        $this->dispatch(new ScheduleUpdatorCommand(
            $userId,
            $id,
            $body['date']
        ));
        return JsonResponse::create("Se ha actualizado correctamente", JsonResponse::HTTP_OK);
    }
}
