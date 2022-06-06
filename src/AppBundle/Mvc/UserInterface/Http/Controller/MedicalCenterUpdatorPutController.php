<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\MedicalCenterUpdatorCommand;
use Mvc\Application\Query\MedicalCenterFinderQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\MedicalCenterUpdatorPutValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/medical-center/{medicalCenterId}", methods={"PUT"}) */
final class MedicalCenterUpdatorPutController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        MedicalCenterUpdatorPutValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $id = $request->attributes->get('medicalCenterId');
        $body = $request->request->all();
        $this->dispatch(new MedicalCenterUpdatorCommand(
            $userId,
            $id,
            $body['name'],
            $body['address'],
            $body['healthPersonnel']
        ));
        $res = $this->ask(new MedicalCenterFinderQuery($userId, $id));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }
}
