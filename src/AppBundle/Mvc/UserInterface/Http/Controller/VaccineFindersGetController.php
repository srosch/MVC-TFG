<?php declare(strict_types=1);
namespace Mvc\UserInterface\Http\Controller;

use Mvc\Application\Query\VaccineFindersQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\EmptyValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;


/** @Route("/mvc/vaccines", methods={"GET"}) */
final class VaccineFindersGetController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        EmptyValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $res = $this->ask(new VaccineFindersQuery($userId));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }
}
