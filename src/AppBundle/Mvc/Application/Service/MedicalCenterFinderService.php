<?php

declare(strict_types=1);

namespace Mvc\Application\Service;

use AppBundle\Mvc\Application\Response\MedicalCenterFinderResponse;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\MedicalCenterFinderQuery;
use Mvc\Domain\Repository\MedicalCenterRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Infrastructure\CQRS\Query\QueryHandler;
use Mvc\Infrastructure\CQRS\Query\Query;

class MedicalCenterFinderService implements QueryHandler
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

    public function __invoke(MedicalCenterFinderQuery $query): array
    {
        $user = $this->userRepository->find($query->userId());
        if (!$user->isAdministrative()) {
            throw new UserHasNotPermissionToAccess();
        }

        $medicalCenter = $this->medicalCenterRepository->find($query->id());
        $response = new MedicalCenterFinderResponse($medicalCenter);
        return $response->toArray();
    }

    public function subscribedTo(): string
    {
        return MedicalCenterFinderQuery::class;
    }

    /**
     * @param MedicalCenterFinderQuery $query
    */
    public function handle(Query $query): array
    {
        return $this->__invoke($query);
    }
}
