<?php

declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use AppBundle\Mvc\Exceptions\OnlineConsultationNotFoundException;
use MongoDB\BSON\ObjectId;
use Mvc\Domain\OnlineConsultation;
use Mvc\Domain\Repository\OnlineConsultationRepository;

class DoctrineOnlineConsultationRepository extends DoctrineRepository implements OnlineConsultationRepository
{
    /** @return OnlineConsultation[] */
    public function findAllByUserId(string $id): array
    {
        return $this->repository()->findBy(
            [
                'patient' => new ObjectId($id)
            ]
        );
    }

    /** @return OnlineConsultation[] */
    public function findPending(): array
    {
        return $this->repository()->findBy(
            [
                'response' => null
            ]
        );
    }

    public function find(string $id): OnlineConsultation
    {
        $res = $this->repository()->find($id);
        if (!$res instanceof OnlineConsultation) {
            throw new OnlineConsultationNotFoundException(['id' => $id]);
        }
        return $res;
    }

    public function update(OnlineConsultation $onlineConsultation): void
    {
        $this->documentManager->persist($onlineConsultation);
        $this->documentManager->flush($onlineConsultation);
    }

    public function save(OnlineConsultation $onlineConsultation): void
    {
        $this->update($onlineConsultation);
    }

    public function remove(OnlineConsultation $onlineConsultation): void
    {
        $this->documentManager->remove($onlineConsultation);
        $this->documentManager->flush($onlineConsultation);
    }

    protected function repositoryClassName(): string
    {
        return OnlineConsultation::class;
    }
}
