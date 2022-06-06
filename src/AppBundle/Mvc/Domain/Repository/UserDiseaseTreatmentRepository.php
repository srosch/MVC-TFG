<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;

use Mvc\Domain\UserDiseaseTreatment;

interface UserDiseaseTreatmentRepository
{
    /** @return UserDiseaseTreatment[] */
    public function findAllByHistoryDisease(string $id): array;

    public function save(UserDiseaseTreatment $historyUserDisease): void;

    public function update(UserDiseaseTreatment $historyUserDisease): void;

    public function remove(UserDiseaseTreatment $historyUserDisease): void;
}
