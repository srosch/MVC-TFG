<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;

use Mvc\Domain\UserDocument;

interface UserDocumentRepository
{
    /** @return UserDocument[] */
    public function findAllByUserId(string $id): array;

    public function find(string $id): UserDocument;

    public function save(UserDocument $userDocument): void;

    public function update(UserDocument $userDocument): void;

    public function remove(UserDocument $userDocument): void;
}
