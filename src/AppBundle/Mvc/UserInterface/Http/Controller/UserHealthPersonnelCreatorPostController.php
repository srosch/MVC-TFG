<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\UserHealthPersonnelCreatorCommand;
use AppBundle\Mvc\Application\General\IdGenerator;
use Mvc\Application\Query\UserFinderQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\UserHealthPersonnelCreatorPostValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/health-personnel", methods={"POST"}) */
final class UserHealthPersonnelCreatorPostController extends BaseController
{
    /** @var IdGenerator */
    private $idGenerator;

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        UserHealthPersonnelCreatorPostValidator $validator,
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
        $body = $this->parseBody($request->request->all());
        $this->dispatch(new UserHealthPersonnelCreatorCommand(
            $userId,
            $id,
            $body['name'],
            $body['firstLastName'],
            $body['secondLastName'],
            $body['email'],
            $body['password'],
            $body['address'],
            $body['municipality'],
            $body['postalCode'],
            $body['telephone'],
            $body['mobilephone'],
            $body['nif']
        ));
        $res = $this->ask(new UserFinderQuery($userId, $id));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }

    private function defaultRequestFields(): array
    {
        return [
            'secondLastName' => null,
            'telephone' => null,
            'mobilephone' => null
        ];
    }

    /** @throws Throwable */
    private function parseBody(array $body): array
    {
        return array_merge($this->defaultRequestFields(), $body);
    }
}
