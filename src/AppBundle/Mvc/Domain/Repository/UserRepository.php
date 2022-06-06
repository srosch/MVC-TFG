<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;


use AppBundle\Mvc\Exceptions\UserNotFoundException;
use Mvc\Domain\User;

interface UserRepository
{
    /** @throws UserNotFoundException */
    public function find(string $id): User;

    /** @throws UserNotFoundException */
    public function searchByNifOrCip(string $nif): ?User;

    /** @throws UserNotFoundException */
    public function findByEmail(string $email): User;

    /** @throws UserNotFoundException */
    public function searchByEmail(string $email): ?User;

    /** @return User[] */
    public function findAll(): array;

    public function save(User $user): void;

    public function update(User $user): void;

    public function remove(User $user): void;
}
