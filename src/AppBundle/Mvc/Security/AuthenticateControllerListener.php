<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Security;


use AppBundle\Mvc\Application\Query\DecodeTokenQuery;
use AppBundle\Mvc\Exceptions\UnauthorizedTokenException;
use Mvc\Domain\User;
use Mvc\Infrastructure\CQRS\Query\QueryBus;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class AuthenticateControllerListener
{
    /** @var QueryBus */
    private $queryBus;

    public function __construct(
        QueryBus $queryBus
    ) {
        $this->queryBus = $queryBus;
    }

    public function __invoke(KernelEvent $event)
    {
        try {
            $request = $event->getRequest();
            $urlExplode = explode('/', $request->getPathInfo());
            if (count($urlExplode) >= 2 && $urlExplode[1] === 'mvc') {
                $this->actionUrlApi($request);
            }

            return;
        } catch (AuthenticationException $exception) {
            throw new BadCredentialsException();
        }
    }

    public function getUserByToken(string $token): ?User
    {
        try {
            return $this->queryBus->ask(new DecodeTokenQuery($token));
        } catch (AccessDeniedException $e) {
            return null;
        }
    }

    public function actionUrlApi(Request $request)
    {
        $token = $request->headers->get('X-AUTH-TOKEN');

        if ($request->attributes->has('_auth')) {
            $request->attributes->remove('_auth');
        }

        if (is_null($token)) {
            throw new UnauthorizedTokenException();
        }

        $user = $this->getUserByToken($token);

        if (is_null($user)) {
            throw new UnauthorizedTokenException();
        }

        $request->attributes->add(
            [
                '_auth' => $user->getId()
            ]
        );
    }
}
