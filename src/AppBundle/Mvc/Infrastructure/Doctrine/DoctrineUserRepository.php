<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use AppBundle\Mvc\Exceptions\UserNotFoundException;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\User;
use Mvc\Domain\UserRoles;


class DoctrineUserRepository extends DoctrineRepository implements UserRepository
{
    /** @throws UserNotFoundException */
    public function find(string $id): User
    {
        $user = $this->repository()->find($id);
        if ($user === null || !$user instanceof User) {
            throw new UserNotFoundException(['id' => $id]);
        }
        return $user;
    }

    public function searchByNifOrCip(string $nifOrCip): ?User
    {
        $user = $this->repository()->findOneBy(['nif' => $nifOrCip, 'roles' => UserRoles::ROLE_PATIENT]);

        if (is_null($user)) {
            $user = $this->repository()->findOneBy(['cip' => $nifOrCip, 'roles' => UserRoles::ROLE_PATIENT]);

            if (is_null($user)) return null;
            if(!$user instanceof User) {
                throw new UserNotFoundException(['nifOrCip' => $nifOrCip]);
            }
        }
        return $user;
    }

    public function findByEmail(string $email): User
    {
        $user = $this->repository()->findOneBy(['email' => $email]);

        if (is_null($user) || !$user instanceof User) {
            throw new UserNotFoundException(['email' => $email]);
        }
        return $user;
    }

    public function searchByEmail(string $email): ?User
    {
        $user = $this->repository()->findOneBy(['email' => $email]);

        if (is_null($user)) return null;
        if (!$user instanceof User) {
            throw new UserNotFoundException(['email' => $email]);
        }
        return $user;
    }

    /** @return User[] */
    public function findAll(): array
    {
        return $this->repository()->findAll();
    }

    public function update(User $user): void
    {
        $this->documentManager->persist($user);
        $this->documentManager->flush($user);
    }

    public function save(User $user): void
    {
        $this->update($user);
    }

    public function remove(User $user): void
    {
        $this->documentManager->remove($user);
        $this->documentManager->flush($user);
    }

    protected function repositoryClassName(): string
    {
        return User::class;
    }
}
