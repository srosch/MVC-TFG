<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;

use Mvc\Domain\HistoryUserAllergy;

interface HistoryUserAllergyRepository
{
    /** @return HistoryUserAllergy[] */
    public function findAllByUserId(string $id): array;

    public function save(HistoryUserAllergy $historyUserAllergy): void;

    public function update(HistoryUserAllergy $historyUserAllergy): void;

    public function remove(HistoryUserAllergy $historyUserAllergy): void;
}
