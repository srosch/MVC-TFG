<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\OnlineConsultationCreatorCommand;
use AppBundle\Mvc\Application\General\IdGenerator;
use Mvc\Application\Query\OnlineConsultationPatientFindersQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\OnlineConsultationCreatorPostValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/online-consultation", methods={"POST"}) */
final class OnlineConsultationCreatorPostController extends BaseController
{
    /** @var IdGenerator */
    private $idGenerator;

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        OnlineConsultationCreatorPostValidator $validator,
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
        $this->dispatch(new OnlineConsultationCreatorCommand(
            $userId,
            $id,
            $body['date'],
            $body['text']
        ));

        $res = $this->ask(new OnlineConsultationPatientFindersQuery($userId, $userId));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }
}
