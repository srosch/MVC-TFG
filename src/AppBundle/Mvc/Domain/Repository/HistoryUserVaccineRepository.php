<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;

use Mvc\Domain\HistoryUserVaccine;

interface HistoryUserVaccineRepository
{
    /** @return HistoryUserVaccine[] */
    public function findAllByUserId(string $id): array;

    public function save(HistoryUserVaccine $historyUserVaccine): void;

    public function update(HistoryUserVaccine $historyUserVaccine): void;

    public function remove(HistoryUserVaccine $historyUserVaccine): void;
}
