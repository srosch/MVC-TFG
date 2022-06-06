<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use MongoDB\BSON\ObjectId;
use Mvc\Domain\HistoryUserDonations;
use Mvc\Domain\Repository\HistoryUserDonationsRepository;

class DoctrineHistoryUserDonationsRepository extends DoctrineRepository implements HistoryUserDonationsRepository
{
    /** @return HistoryUserDonations[] */
    public function findAllByUserId(string $id): array
    {
        return $this->repository()->findBy(
            [
                'patient' => new ObjectId($id)
            ]
        );
    }

    public function update(HistoryUserDonations $historyUserDonations): void
    {
        $this->documentManager->persist($historyUserDonations);
        $this->documentManager->flush($historyUserDonations);
    }

    public function save(HistoryUserDonations $historyUserDonations): void
    {
        $this->update($historyUserDonations);
    }

    public function remove(HistoryUserDonations $historyUserDonations): void
    {
        $this->documentManager->remove($historyUserDonations);
        $this->documentManager->flush($historyUserDonations);
    }

    protected function repositoryClassName(): string
    {
        return HistoryUserDonations::class;
    }
}
