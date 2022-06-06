<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use AppBundle\Mvc\Exceptions\UserDocumentNotFoundException;
use MongoDB\BSON\ObjectId;
use Mvc\Domain\Repository\UserDocumentRepository;
use Mvc\Domain\UserDocument;

class DoctrineUserDocumentRepository extends DoctrineRepository implements UserDocumentRepository
{
    /** @return UserDocument[] */
    public function findAllByUserId(string $id): array
    {
        return $this->repository()->findBy(
            [
                'patient' => new ObjectId($id)
            ]
        );
    }

    public function find(string $id): UserDocument
    {
        $user = $this->repository()->find($id);
        if ($user === null || !$user instanceof UserDocument) {
            throw new UserDocumentNotFoundException(['id' => $id]);
        }
        return $user;
    }

    public function update(UserDocument $userDocument): void
    {
        $this->documentManager->persist($userDocument);
        $this->documentManager->flush($userDocument);
    }

    public function save(UserDocument $userDocument): void
    {
        $this->update($userDocument);
    }

    public function remove(UserDocument $userDocument): void
    {
        $this->documentManager->remove($userDocument);
        $this->documentManager->flush($userDocument);
    }

    protected function repositoryClassName(): string
    {
        return UserDocument::class;
    }
}
