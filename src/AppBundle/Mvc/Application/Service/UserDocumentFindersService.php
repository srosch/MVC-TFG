<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\UserDocumentFindersResponse;
use AppBundle\Mvc\Application\Response\UserFindersResponse;
use Mvc\Application\Query\UserDocumentFindersQuery;
use Mvc\Domain\Repository\UserDocumentRepository;
use Mvc\Domain\User;
use Mvc\Domain\UserDocument;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class UserDocumentFindersService implements QueryHandler
{
    /** @var UserDocumentRepository */
    private $userDocumentRepository;

    public function __construct(
        UserDocumentRepository $userDocumentRepository
    ) {
        $this->userDocumentRepository = $userDocumentRepository;
    }

    public function __invoke(UserDocumentFindersQuery $query): array
    {
        $documents = $this->userDocumentRepository->findAllByUserId($query->userId());
        return array_map(function (UserDocument $document) {
            $serialized = new UserDocumentFindersResponse($document);
            return $serialized->toArray();
        }, $documents);
    }

    public function subscribedTo(): string
    {
        return UserDocumentFindersQuery::class;
    }

    /**
     * @param UserDocumentFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
