<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use AppBundle\Mvc\Exceptions\HistoryUserDiseaseNotFoundException;
use MongoDB\BSON\ObjectId;
use Mvc\Domain\HistoryUserDisease;
use Mvc\Domain\Repository\HistoryUserDiseaseRepository;

class DoctrineHistoryUserDiseaseRepository extends DoctrineRepository implements HistoryUserDiseaseRepository
{
    /** @return HistoryUserDisease[] */
    public function findAllByUserId(string $id): array
    {
        return $this->repository()->findBy(
            [
                'patient' => new ObjectId($id)
            ]
        );
    }

    public function find(string $id): HistoryUserDisease
    {
        $h = $this->repository()->find($id);
        if ($h === null || !$h instanceof HistoryUserDisease) {
            throw new HistoryUserDiseaseNotFoundException(['id' => $id]);
        }
        return $h;
    }

    public function update(HistoryUserDisease $historyUserDisease): void
    {
        $this->documentManager->persist($historyUserDisease);
        $this->documentManager->flush($historyUserDisease);
    }

    public function save(HistoryUserDisease $historyUserDisease): void
    {
        $this->update($historyUserDisease);
    }

    public function remove(HistoryUserDisease $historyUserDisease): void
    {
        $this->documentManager->remove($historyUserDisease);
        $this->documentManager->flush($historyUserDisease);
    }

    protected function repositoryClassName(): string
    {
        return HistoryUserDisease::class;
    }
}
