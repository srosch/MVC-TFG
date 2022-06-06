<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Middleware;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Throwable;

final class JSONRequestMiddleware
{
    public function onKernelRequest(GetResponseEvent $event): void
    {
        $this->__invoke($event);
    }

    public function __invoke(GetResponseEvent $event): void
    {
        $request = $event->getRequest();
        if (false === strpos($request->getUri(), 'mvc')) {
            return;
        }
        if (0 === strpos(strval($request->headers->get('Content-Type', null)), 'application/json')) {
            try {
                $request->request->replace(json_decode((string)$request->getContent(), true, 512));
            } catch (Throwable $err) {
            }
        }
    }
}
