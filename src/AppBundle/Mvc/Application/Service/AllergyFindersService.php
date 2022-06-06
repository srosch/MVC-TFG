<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\AllergyFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\AllergyFindersQuery;
use Mvc\Domain\Allergy;
use Mvc\Domain\Repository\AllergyRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class AllergyFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var AllergyRepository */
    private $allergyRepository;
    public function __construct(
        UserRepository $userRepository,
        AllergyRepository $allergyRepository
    ) {
        $this->userRepository = $userRepository;
        $this->allergyRepository = $allergyRepository;
    }

    public function __invoke(AllergyFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isHealthPersonnel()) {
            throw new UserHasNotPermissionToAccess();
        }
        $allergies = $this->allergyRepository->findAll();
        return array_map(function (Allergy $allergy) {
            $serialized = new AllergyFindersResponse($allergy);
            return $serialized->toArray();
        }, $allergies);
    }

    public function subscribedTo(): string
    {
        return AllergyFindersQuery::class;
    }

    /**
     * @param AllergyFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
