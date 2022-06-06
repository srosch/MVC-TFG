<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Query\EncodeTokenQuery;
use AppBundle\Mvc\Domain\EncodeTokenDTO;
use AppBundle\Mvc\Exceptions\BadCredentialsExceptionMvc;
use AppBundle\Mvc\Exceptions\UserNotFoundException;
use Mvc\Domain\Factory\TokenFactory;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class EncodeTokenService implements QueryHandler
{
    /** @var UserPasswordEncoderInterface */
    private $userPasswordEncoder;
    /** @var TokenFactory */
    private $tokenFactory;
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        TokenFactory $tokenFactory,
        UserRepository $userRepository
    ) {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->tokenFactory = $tokenFactory;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws UserNotFoundException
     * @throws BadCredentialsExceptionMvc
     */
    public function __invoke(EncodeTokenQuery $query): array
    {
        $user = $this->userRepository->findByEmail($query->email());
        if (!$this->userPasswordEncoder->isPasswordValid($user, $query->password())) {
            throw new BadCredentialsExceptionMvc(["password" => "Invalid password"]);
        }

        $build = $this->tokenFactory->encode($user->getId());
        return (new EncodeTokenDTO(
            $build['token'],
            $build['end_date']
        ))->toArray();
    }

    public function subscribedTo(): string
    {
        return EncodeTokenQuery::class;
    }

    /** @param EncodeTokenQuery $query */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
