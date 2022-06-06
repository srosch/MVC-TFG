<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\UserDiseaseTreatmentCreatorCommand;
use AppBundle\Mvc\Application\General\IdGenerator;
use Mvc\Application\Query\UserDiseaseTreatmentFindersQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\UserDiseaseTreatmentCreatorPostValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/user-disease/treatment", methods={"POST"}) */
final class UserDiseaseTreatmentCreatorPostController extends BaseController
{
    /** @var IdGenerator */
    private $idGenerator;

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        UserDiseaseTreatmentCreatorPostValidator $validator,
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
        $this->dispatch(
            new UserDiseaseTreatmentCreatorCommand(
                $userId,
                $id,
                $body['historyUserDisease'],
                $body['initDate'],
                $body['endDate'] ?? null,
                $body['notes']
            )
        );

        $res = $this->ask(new UserDiseaseTreatmentFindersQuery($userId, $body['historyUserDisease']));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }
}
