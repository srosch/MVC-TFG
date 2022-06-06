<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;

use Mvc\Domain\Vaccine;

interface VaccineRepository
{
    /** @return Vaccine[] */
    public function findAll(): array;

    public function find(string $id): Vaccine;

    public function save(Vaccine $vaccine): void;

    public function update(Vaccine $vaccine): void;

    public function remove(Vaccine $vaccine): void;
}
