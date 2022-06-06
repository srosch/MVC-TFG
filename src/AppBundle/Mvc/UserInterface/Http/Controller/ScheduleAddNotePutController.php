<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\ScheduleAddNoteCommand;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\ScheduleAddNotePutValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/schedule/add-note/{scheduleId}", methods={"PUT"}) */
final class ScheduleAddNotePutController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        ScheduleAddNotePutValidator $validator
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
        $this->dispatch(new ScheduleAddNoteCommand(
            $userId,
            $id,
            $body['date'],
            $body['text']
        ));
        return JsonResponse::create("Se ha añadido la nota correctamente", JsonResponse::HTTP_OK);
    }
}
