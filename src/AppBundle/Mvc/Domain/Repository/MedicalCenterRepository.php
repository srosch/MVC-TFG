<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;


use Mvc\Domain\MedicalCenter;

interface MedicalCenterRepository
{
    /** @return MedicalCenter[] */
    public function findAll(): array;

    public function find(string $id): MedicalCenter;

    public function save(MedicalCenter $medicalCenter): void;

    public function update(MedicalCenter $medicalCenter): void;

    public function remove(MedicalCenter $medicalCenter): void;
}
