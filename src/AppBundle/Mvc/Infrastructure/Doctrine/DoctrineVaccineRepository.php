<?php declare(strict_types=1);
namespace Mvc\Infrastructure\Doctrine;

use AppBundle\Mvc\Exceptions\VaccineNotFoundException;
use Mvc\Domain\Repository\VaccineRepository;
use Mvc\Domain\Vaccine;

class DoctrineVaccineRepository extends DoctrineRepository implements VaccineRepository
{
    /** @return Vaccine[] */
    public function findAll(): array
    {
        return $this->repository()->findAll();
    }

    public function find(string $id): Vaccine
    {
        $vaccine = $this->repository()->find($id);
        if ($vaccine === null || !$vaccine instanceof Vaccine) {
            throw new VaccineNotFoundException(['id' => $id]);
        }
        return $vaccine;
    }

    public function update(Vaccine $vaccine): void
    {
        $this->documentManager->persist($vaccine);
        $this->documentManager->flush($vaccine);
    }

    public function save(Vaccine $vaccine): void
    {
        $this->update($vaccine);
    }

    public function remove(Vaccine $vaccine): void
    {
        $this->documentManager->remove($vaccine);
        $this->documentManager->flush($vaccine);
    }

    protected function repositoryClassName(): string
    {
        return Vaccine::class;
    }
}
