<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\UserPatientCreatorCommand;
use AppBundle\Mvc\Application\General\IdGenerator;
use Mvc\Application\Query\UserFinderQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\UserPatientCreatorPostValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/patient", methods={"POST"}) */
final class UserPatientCreatorPostController extends BaseController
{
    /** @var IdGenerator */
    private $idGenerator;

    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        UserPatientCreatorPostValidator $validator,
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
        $this->dispatch(new UserPatientCreatorCommand(
            $userId,
            $id,
            $body['name'],
            $body['firstLastName'],
            $body['secondLastName'],
            $body['sex'],
            $body['email'],
            $body['password'],
            $body['bloodType'],
            $body['birthDate'],
            $body['birthPlace'],
            $body['birthWeight'],
            $body['birthSize'],
            $body['birthNotes'],
            $body['address'],
            $body['municipality'],
            $body['postalCode'],
            $body['telephone'],
            $body['mobilephone'],
            $body['notifications'],
            $body['cip'],
            $body['nif']
        ));
        $res = $this->ask(new UserFinderQuery($userId, $id));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }

    private function defaultRequestFields(): array
    {
        return [
            'secondLastName' => null,
            'bloodType' => null,
            'telephone' => null,
            'mobilephone' => null,
            'cip' => null,
            'nif' => null
        ];
    }

    /** @throws Throwable */
    private function parseBody(array $body): array
    {
        return array_merge($this->defaultRequestFields(), $body);
    }
}
