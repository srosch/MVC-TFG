<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;


use AppBundle\Mvc\Exceptions\AllergyNotFoundException;
use Mvc\Domain\Allergy;
use Mvc\Domain\Repository\AllergyRepository;


class DoctrineAllergyRepository extends DoctrineRepository implements AllergyRepository
{
    /** @return Allergy[] */
    public function findAll(): array
    {
        return $this->repository()->findAll();
    }

    /**
     * @throws AllergyNotFoundException
     */
    public function find(string $id): Allergy
    {
        $allergy = $this->repository()->find($id);
        if ($allergy === null || !$allergy instanceof Allergy) {
            throw new AllergyNotFoundException(['id' => $id]);
        }
        return $allergy;
    }

    public function update(Allergy $allergy): void
    {
        $this->documentManager->persist($allergy);
        $this->documentManager->flush($allergy);
    }

    public function save(Allergy $allergy): void
    {
        $this->update($allergy);
    }

    public function remove(Allergy $allergy): void
    {
        $this->documentManager->remove($allergy);
        $this->documentManager->flush($allergy);
    }

    protected function repositoryClassName(): string
    {
        return Allergy::class;
    }
}
