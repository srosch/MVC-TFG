<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\UserFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\UserFindersQuery;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\User;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class UserFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if ($user->isPatient()) {
            throw new UserHasNotPermissionToAccess();
        }
        $users = $this->userRepository->findAll();
        return array_map(function (User $user) {
            $serialized = new UserFindersResponse($user);
            return $serialized->toArray();
        }, $users);
    }

    public function subscribedTo(): string
    {
        return UserFindersQuery::class;
    }

    /**
     * @param UserFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
