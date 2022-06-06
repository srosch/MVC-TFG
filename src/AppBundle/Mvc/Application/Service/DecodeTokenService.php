<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Query\DecodeTokenQuery;
use Mvc\Domain\Factory\TokenFactory;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\User;
use Mvc\Infrastructure\CQRS\Query\Query;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

final class DecodeTokenService implements QueryHandler
{
    /** @var TokenFactory */
    private $factory;
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        TokenFactory $tokenFactory,
        UserRepository $userRepository
    ) {
        $this->factory = $tokenFactory;
        $this->userRepository = $userRepository;
    }

    public function __invoke(DecodeTokenQuery $query): User
    {
        $token = $query->token();
        $payload = $this->factory->decode($token);

        if (empty($payload) || !isset($payload['uuid'])) {
            throw new BadCredentialsException(
                sprintf('Auth invalid credentials with token {%s}.', $token)
            );
        }
        /** @var string $id */
        $id = $payload['uuid'];
        return $this->userRepository->find($id);
    }

    public function subscribedTo(): string
    {
        return DecodeTokenQuery::class;
    }

    /**
     * @param DecodeTokenQuery $query
     */
    public function handle(Query $query): User
    {
        return $this->__invoke($query);
    }
}
