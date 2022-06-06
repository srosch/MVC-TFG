<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use MongoDB\BSON\ObjectId;
use Mvc\Domain\HistoryUserAllergy;
use Mvc\Domain\HistoryUserDonations;
use Mvc\Domain\Repository\HistoryUserAllergyRepository;
use Mvc\Domain\Repository\HistoryUserDonationsRepository;

class DoctrineHistoryUserAllergyRepository extends DoctrineRepository implements HistoryUserAllergyRepository
{
    /** @return HistoryUserAllergy[] */
    public function findAllByUserId(string $id): array
    {
        return $this->repository()->findBy(
            [
                'patient' => new ObjectId($id)
            ]
        );
    }

    public function update(HistoryUserAllergy $historyUserAllergy): void
    {
        $this->documentManager->persist($historyUserAllergy);
        $this->documentManager->flush($historyUserAllergy);
    }

    public function save(HistoryUserAllergy $historyUserAllergy): void
    {
        $this->update($historyUserAllergy);
    }

    public function remove(HistoryUserAllergy $historyUserAllergy): void
    {
        $this->documentManager->remove($historyUserAllergy);
        $this->documentManager->flush($historyUserAllergy);
    }

    protected function repositoryClassName(): string
    {
        return HistoryUserAllergy::class;
    }
}
