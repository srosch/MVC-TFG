<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Query\EncodeTokenQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\LoginPostValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/login", methods={"POST"}) */
class LoginPostController extends BaseController
{

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        LoginPostValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $body = $request->request->all();
        $token = $this->ask(new EncodeTokenQuery(
            $body['email'],
            $body['password']
        ));

        return JsonResponse::create($token, JsonResponse::HTTP_OK);
    }
}
