<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use Mvc\Application\Query\UserAutenticatedFinderQuery;
use Mvc\Application\Response\UserAutenticatedFinderResponse;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class UserAutenticatedFinderService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserAutenticatedFinderQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        $response = new UserAutenticatedFinderResponse($user);
        return $response->toArray();
    }

    public function subscribedTo(): string
    {
        return UserAutenticatedFinderQuery::class;
    }

    /**
     * @param UserAutenticatedFinderQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
