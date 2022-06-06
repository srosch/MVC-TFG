<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Middleware;

use AppBundle\Mvc\Exceptions\BadRequestExceptionMvc;
use AppBundle\Mvc\Exceptions\ConflictExceptionMvc;
use AppBundle\Mvc\Exceptions\ExceptionMvc;
use AppBundle\Mvc\Exceptions\NotFoundExceptionMvc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use TypeError;

final class HttpExceptionMiddleware
{
    /** @var bool */
    private $isDebug;

    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $this->__invoke($event);
    }

    public function __invoke(GetResponseForExceptionEvent $event): void
    {
        $error = $event->getException();
        $response = $this->createResponse($error);
        $event->setResponse($response);
    }

    private function createResponse(Throwable $error): JsonResponse
    {
        $status = $error instanceof ExceptionMvc
            ? $this->customErrorMappingToStatus($error)
            : $this->genericErrorMappingToStatus($error);
        $data = $this->genericErrorMappingToData($error);
        return new JsonResponse($data, $status);
    }

    private function customErrorMappingToStatus(ExceptionMvc $error): int
    {
        if ($error instanceof BadRequestExceptionMvc) {
            return JsonResponse::HTTP_BAD_REQUEST;
        }
        if ($error instanceof NotFoundExceptionMvc) {
            return JsonResponse::HTTP_NOT_FOUND;
        }
        if ($error instanceof ConflictExceptionMvc) {
            return JsonResponse::HTTP_CONFLICT;
        }
        return $error->getCode();
    }

    private function genericErrorMappingToStatus(Throwable $error): int
    {
        if ($error instanceof TypeError) {
            return JsonResponse::HTTP_BAD_REQUEST;
        }
        if ($error instanceof UnauthorizedHttpException) {
            return JsonResponse::HTTP_UNAUTHORIZED;
        }
        if ($error instanceof BadRequestHttpException) {
            return $error->getStatusCode() ?? JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        }

        if ($error instanceof NotFoundHttpException) {
            return $error->getStatusCode() ?? JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        }

        if ($error instanceof MethodNotAllowedHttpException) {
            return $error->getStatusCode() ?? JsonResponse::HTTP_METHOD_NOT_ALLOWED;
        }

        return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
    }

    private function genericErrorMappingToData(Throwable $error): array
    {
        if ($this->isDebug) {
            return array_merge(
                ['error' => $error->getMessage()],
                $error instanceof ExceptionMvc ? ['meta' => $error->meta()] : ['trace' => $error->getTrace()]
            );
        }
        if ($error instanceof ExceptionMvc) {
            return ['error' => $error->getMessage()];
        }
        if ($error instanceof NotFoundHttpException) {
            return ['error' => $error->getMessage()];
        }
        if ($error instanceof UnauthorizedHttpException) {
            return ['error' => $error->getMessage()];
        }
        return ['error' => $error->getMessage()];
    }
}
