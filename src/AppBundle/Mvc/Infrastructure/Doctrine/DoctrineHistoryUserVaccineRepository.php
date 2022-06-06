<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use MongoDB\BSON\ObjectId;
use Mvc\Domain\HistoryUserVaccine;
use Mvc\Domain\Repository\HistoryUserVaccineRepository;

class DoctrineHistoryUserVaccineRepository extends DoctrineRepository implements HistoryUserVaccineRepository
{
    /** @return HistoryUserVaccine[] */
    public function findAllByUserId(string $id): array
    {
        return $this->repository()->findBy(
            [
                'patient' => new ObjectId($id)
            ]
        );
    }

    public function update(HistoryUserVaccine $historyUserVaccine): void
    {
        $this->documentManager->persist($historyUserVaccine);
        $this->documentManager->flush($historyUserVaccine);
    }

    public function save(HistoryUserVaccine $historyUserVaccine): void
    {
        $this->update($historyUserVaccine);
    }

    public function remove(HistoryUserVaccine $historyUserVaccine): void
    {
        $this->documentManager->remove($historyUserVaccine);
        $this->documentManager->flush($historyUserVaccine);
    }

    protected function repositoryClassName(): string
    {
        return HistoryUserVaccine::class;
    }
}
