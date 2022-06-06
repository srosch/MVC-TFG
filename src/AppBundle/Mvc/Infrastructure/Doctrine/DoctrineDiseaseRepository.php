<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use AppBundle\Mvc\Exceptions\DiseaseNotFoundException;
use Mvc\Domain\Disease;
use Mvc\Domain\Repository\DiseaseRepository;

class DoctrineDiseaseRepository extends DoctrineRepository implements DiseaseRepository
{
    /** @return Disease[] */
    public function findAll(): array
    {
        return $this->repository()->findAll();
    }

    public function find(string $id): Disease
    {
        $disease = $this->repository()->find($id);
        if ($disease === null || !$disease instanceof Disease) {
            throw new DiseaseNotFoundException(['id' => $id]);
        }
        return $disease;
    }

    public function update(Disease $disease): void
    {
        $this->documentManager->persist($disease);
        $this->documentManager->flush($disease);
    }

    public function save(Disease $disease): void
    {
        $this->update($allergy);
    }

    public function remove(Disease $disease): void
    {
        $this->documentManager->remove($disease);
        $this->documentManager->flush($disease);
    }

    protected function repositoryClassName(): string
    {
        return Disease::class;
    }
}
