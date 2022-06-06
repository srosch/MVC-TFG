<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use AppBundle\Mvc\Exceptions\MedicalCenterNotFoundException;
use Mvc\Domain\MedicalCenter;
use Mvc\Domain\Repository\MedicalCenterRepository;

class DoctrineMedicalCenterRepository extends DoctrineRepository implements MedicalCenterRepository
{
    /** @return MedicalCenter[] */
    public function findAll(): array
    {
        return $this->repository()->findAll();
    }

    public function update(MedicalCenter $medicalCenter): void
    {
        $this->documentManager->persist($medicalCenter);
        $this->documentManager->flush($medicalCenter);
    }

    public function save(MedicalCenter $medicalCenter): void
    {
        $this->update($medicalCenter);
    }

    public function remove(MedicalCenter $medicalCenter): void
    {
        $this->documentManager->remove($medicalCenter);
        $this->documentManager->flush($medicalCenter);
    }

    protected function repositoryClassName(): string
    {
        return MedicalCenter::class;
    }

    public function find(string $id): MedicalCenter
    {
        $medicalCenter = $this->repository()->find($id);
        if ($medicalCenter === null || !$medicalCenter instanceof MedicalCenter) {
            throw new MedicalCenterNotFoundException(['id' => $id]);
        }
        return $medicalCenter;
    }
}
