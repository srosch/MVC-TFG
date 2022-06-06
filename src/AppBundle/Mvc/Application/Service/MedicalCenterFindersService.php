<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\MedicalCenterFindersResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\MedicalCenterFindersQuery;
use Mvc\Domain\MedicalCenter;
use Mvc\Domain\Repository\MedicalCenterRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class MedicalCenterFindersService implements QueryHandler
{
    /** @var UserRepository */
    private $userRepository;
    /** @var MedicalCenterRepository */
    private $medicalCenterRepository;
    public function __construct(
        UserRepository $userRepository,
        MedicalCenterRepository $medicalCenterRepository
    ) {
        $this->userRepository = $userRepository;
        $this->medicalCenterRepository = $medicalCenterRepository;
    }

    public function __invoke(MedicalCenterFindersQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isAdministrative()) {
            throw new UserHasNotPermissionToAccess();
        }

        $medicalCenters = $this->medicalCenterRepository->findAll();
        return array_map(function (MedicalCenter $medicalCenter) {
            $serialized = new MedicalCenterFindersResponse($medicalCenter);
            return $serialized->toArray();
        }, $medicalCenters);
    }

    public function subscribedTo(): string
    {
        return MedicalCenterFindersQuery::class;
    }

    /**
     * @param MedicalCenterFindersQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
