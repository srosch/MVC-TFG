<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\UserFinderResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\UserFinderQuery;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class UserFinderService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserFinderQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if ($user->isPatient()) {
            throw new UserHasNotPermissionToAccess();
        }

        $user = $this->userRepository->find($query->id());
        $response = new UserFinderResponse($user);
        return $response->toArray();
    }

    public function subscribedTo(): string
    {
        return UserFinderQuery::class;
    }

    /**
     * @param UserFinderQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
