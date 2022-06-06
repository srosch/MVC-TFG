<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\UserDocumentFinderResponse;
use AppBundle\Mvc\Application\Response\UserFinderResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\UserDocumentFinderQuery;
use Mvc\Application\Query\UserFinderQuery;
use Mvc\Domain\Repository\UserDocumentRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class UserDocumentFinderService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var UserDocumentRepository */
    private $userDocumentRepository;

    public function __construct(
        UserRepository $userRepository,
        UserDocumentRepository $userDocumentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userDocumentRepository = $userDocumentRepository;
    }

    public function __invoke(UserDocumentFinderQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        $document = $this->userDocumentRepository->find($query->id());
        if (!$user->isPatient() || !($user->isPatient() && $user->getId() === $document->getPatient()->getId())) {
            throw new UserHasNotPermissionToAccess();
        }

        $response = new UserDocumentFinderResponse($document);
        return $response->toArray();
    }

    public function subscribedTo(): string
    {
        return UserDocumentFinderQuery::class;
    }

    /**
     * @param UserDocumentFinderQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
