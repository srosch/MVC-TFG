<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;

use Mvc\Domain\Allergy;

interface AllergyRepository
{
    /** @return Allergy[] */
    public function findAll(): array;

    public function find(string $id): Allergy;

    public function save(Allergy $allergy): void;

    public function update(Allergy $allergy): void;

    public function remove(Allergy $allergy): void;
}
