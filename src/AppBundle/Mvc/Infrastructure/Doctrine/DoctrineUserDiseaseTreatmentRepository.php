<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use MongoDB\BSON\ObjectId;
use Mvc\Domain\Repository\UserDiseaseTreatmentRepository;
use Mvc\Domain\UserDiseaseTreatment;

class DoctrineUserDiseaseTreatmentRepository extends DoctrineRepository implements UserDiseaseTreatmentRepository
{
    /** @return UserDiseaseTreatment[] */
    public function findAllByHistoryDisease(string $id): array
    {
        return $this->repository()->findBy(
            [
                'historyUserDisease' => new ObjectId($id)
            ]
        );
    }

    public function update(UserDiseaseTreatment $userDiseaseTreatment): void
    {
        $this->documentManager->persist($userDiseaseTreatment);
        $this->documentManager->flush($userDiseaseTreatment);
    }

    public function save(UserDiseaseTreatment $userDiseaseTreatment): void
    {
        $this->update($userDiseaseTreatment);
    }

    public function remove(UserDiseaseTreatment $userDiseaseTreatment): void
    {
        $this->documentManager->remove($userDiseaseTreatment);
        $this->documentManager->flush($userDiseaseTreatment);
    }

    protected function repositoryClassName(): string
    {
        return UserDiseaseTreatment::class;
    }
}
