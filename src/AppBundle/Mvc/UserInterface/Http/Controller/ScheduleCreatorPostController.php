<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\ScheduleCreatorCommand;
use AppBundle\Mvc\Application\General\IdGenerator;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\ScheduleCreatorPostValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/schedule", methods={"POST"}) */
final class ScheduleCreatorPostController extends BaseController
{
    /** @var IdGenerator */
    private $idGenerator;

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        ScheduleCreatorPostValidator $validator,
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
        $this->dispatch(new ScheduleCreatorCommand(
            $userId,
            $id,
            $body['patient'],
            $body['center'],
            $body['healthPersonnel'],
            $body['date'],
            $body['text']
        ));
        return JsonResponse::create("Se ha creado correctamente", JsonResponse::HTTP_OK);
    }
}
