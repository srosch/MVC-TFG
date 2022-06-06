<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\UserPatientModifyContactDataCommand;
use Mvc\Application\Query\UserFinderQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\UserPatientModifyContactDataPutValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/patient/{patientId}/modify-contact-data", methods={"PUT"}) */
final class UserPatientModifyContactDataPutController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        UserPatientModifyContactDataPutValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $id = $request->attributes->get('patientId');
        $body = $this->parseBody($request->request->all());
        $this->dispatch(new UserPatientModifyContactDataCommand(
            $userId,
            $id,
            $body['email'],
            $body['address'],
            $body['municipality'],
            $body['postalCode'],
            $body['telephone'],
            $body['mobilephone'],
            $body['notifications']
        ));
        $res = $this->ask(new UserFinderQuery($userId, $id));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }

    private function defaultRequestFields(): array
    {
        return [
            'telephone' => null,
            'mobilephone' => null,
            'notifications' => false
        ];
    }

    /** @throws Throwable */
    private function parseBody(array $body): array
    {
        return array_merge($this->defaultRequestFields(), $body);
    }
}
