<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Controller;

use AppBundle\Mvc\Application\Command\OnlineConsultationResponseCommand;
use Mvc\Application\Query\OnlineConsultationPendingFindersQuery;
use Mvc\Infrastructure\CQRS\Command\CommandBus;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Mvc\UserInterface\Http\Validator\OnlineConsultationResponsePutValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

/** @Route("/mvc/online-consultation/{onlineConsultationId}/response", methods={"PUT"}) */
final class OnlineConsultationResponsePutController extends BaseController
{
    public function __construct(
        QueryBus $queryBus,
        CommandBus $commandBus,
        OnlineConsultationResponsePutValidator $validator
    ) {
        parent::__construct($queryBus, $commandBus, $validator);
    }
    /** @throws Throwable */
    public function __invoke(Request $request): JsonResponse
    {
        $this->validate($request);
        $userId = $request->attributes->get('_auth');
        $id = $request->attributes->get('onlineConsultationId');
        $body = $request->request->all();
        $this->dispatch(new OnlineConsultationResponseCommand(
            $userId,
            $id,
            $body['date'],
            $body['text']
        ));
        $res = $this->ask(new OnlineConsultationPendingFindersQuery($userId));
        return JsonResponse::create($res, JsonResponse::HTTP_OK);
    }
}
