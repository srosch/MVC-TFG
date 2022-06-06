<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\MedicalCenterCreatorCommand;
use AppBundle\Mvc\Application\General\IdGenerator;
use Mvc\Application\Query\MedicalCenterFinderQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\MedicalCenterCreatorPostValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/medical-center", methods={"POST"}) */
final class MedicalCenterCreatorPostController extends BaseController
{
    /** @var IdGenerator */
    private $idGenerator;

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        MedicalCenterCreatorPostValidator $validator,
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
        $this->dispatch(new MedicalCenterCreatorCommand(
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
