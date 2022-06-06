<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use Mvc\Application\Query\UserFindByNifOrCipQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\UserFindByNifOrCipFinderGetValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;


/** @Route("/mvc/user/search/{nifOrCip}", methods={"GET"}) */
final class UserFindByNifOrCipFinderGetController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        UserFindByNifOrCipFinderGetValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $nifOrCip = $request->attributes->get('nifOrCip');
        $res = $this->ask(new UserFindByNifOrCipQuery($userId, $nifOrCip));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }
}
