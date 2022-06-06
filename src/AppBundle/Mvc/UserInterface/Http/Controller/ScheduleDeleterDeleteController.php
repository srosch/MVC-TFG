<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\ScheduleDeleterCommand;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\ScheduleDeleteValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/schedule/{scheduleId}", methods={"DELETE"}) */
final class ScheduleDeleterDeleteController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        ScheduleDeleteValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $id = $request->attributes->get('scheduleId');
        $this->dispatch(new ScheduleDeleterCommand(
            $userId,
            $id
        ));
        return JsonResponse::create("Se ha eliminado correctamente", JsonResponse::HTTP_OK);
    }
}
