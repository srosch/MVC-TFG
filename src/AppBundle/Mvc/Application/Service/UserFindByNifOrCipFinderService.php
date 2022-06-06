<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\UserFindByNifOrCipFinderResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\UserFindByNifOrCipQuery;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class UserFindByNifOrCipFinderService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserFindByNifOrCipQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if ($user->isPatient()) {
            throw new UserHasNotPermissionToAccess();
        }

        $user = $this->userRepository->searchByNifOrCip($query->nifOrCip());
        if ($user === null) {
            return [];
        }
        $response = new UserFindByNifOrCipFinderResponse($user);
        return $response->toArray();
    }

    public function subscribedTo(): string
    {
        return UserFindByNifOrCipQuery::class;
    }

    /**
     * @param UserFindByNifOrCipQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
