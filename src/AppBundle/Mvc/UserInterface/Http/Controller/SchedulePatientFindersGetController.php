<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use Mvc\Application\Query\SchedulePatientFindersQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\SchedulePatientFindersGetValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/schedules/{patient}", methods={"GET"}) */
final class SchedulePatientFindersGetController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        SchedulePatientFindersGetValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $id = $request->attributes->get('patient');
        $res = $this->ask(new SchedulePatientFindersQuery($userId, $id));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }
}
