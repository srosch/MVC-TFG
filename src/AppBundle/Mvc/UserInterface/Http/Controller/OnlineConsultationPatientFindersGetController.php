<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use Mvc\Application\Query\OnlineConsultationPatientFindersQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\OnlineConsultationPatientFindersGetValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/online-consultation/{patient}", methods={"GET"}) */
final class OnlineConsultationPatientFindersGetController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        OnlineConsultationPatientFindersGetValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $id = $request->attributes->get('patient');
        $res = $this->ask(new OnlineConsultationPatientFindersQuery($userId, $id));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }
}
