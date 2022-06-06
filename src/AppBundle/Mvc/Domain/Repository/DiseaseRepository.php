<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;

use Mvc\Domain\Disease;

interface DiseaseRepository
{
    /** @return Disease[] */
    public function findAll(): array;

    public function find(string $id): Disease;

    public function save(Disease $disease): void;

    public function update(Disease $disease): void;

    public function remove(Disease $disease): void;
}
