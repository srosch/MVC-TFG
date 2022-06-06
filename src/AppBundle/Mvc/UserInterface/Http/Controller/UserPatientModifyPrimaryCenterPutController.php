<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\UserPatientModifyPrimaryCenterCommand;
use Mvc\Application\Query\UserFinderQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\UserPatientModifyPrimaryCenterPutValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/patient/{patientId}/modify-primary-center", methods={"PUT"}) */
final class UserPatientModifyPrimaryCenterPutController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        UserPatientModifyPrimaryCenterPutValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $id = $request->attributes->get('patientId');
        $body = $request->request->all();
        $this->dispatch(new UserPatientModifyPrimaryCenterCommand(
            $userId,
            $id,
            $body['doctor'],
            $body['nurse'],
            $body['primaryCenter']
        ));
        $res = $this->ask(new UserFinderQuery($userId, $id));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }
}
