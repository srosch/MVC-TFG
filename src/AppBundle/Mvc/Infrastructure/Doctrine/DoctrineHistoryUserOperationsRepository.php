<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use MongoDB\BSON\ObjectId;
use Mvc\Domain\HistoryUserOperations;
use Mvc\Domain\Repository\HistoryUserOperationsRepository;

class DoctrineHistoryUserOperationsRepository extends DoctrineRepository implements HistoryUserOperationsRepository
{
    /** @return HistoryUserOperations[] */
    public function findAllByUserId(string $id): array
    {
        return $this->repository()->findBy(
            [
                'patient' => new ObjectId($id)
            ]
        );
    }

    public function update(HistoryUserOperations $historyUserOperations): void
    {
        $this->documentManager->persist($historyUserOperations);
        $this->documentManager->flush($historyUserOperations);
    }

    public function save(HistoryUserOperations $historyUserOperations): void
    {
        $this->update($historyUserOperations);
    }

    public function remove(HistoryUserOperations $historyUserOperations): void
    {
        $this->documentManager->remove($historyUserOperations);
        $this->documentManager->flush($historyUserOperations);
    }

    protected function repositoryClassName(): string
    {
        return HistoryUserOperations::class;
    }
}
