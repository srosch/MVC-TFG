<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;

use Mvc\Domain\HistoryUserDisease;

interface HistoryUserDiseaseRepository
{
    /** @return HistoryUserDisease[] */
    public function findAllByUserId(string $id): array;

    public function find(string $id): HistoryUserDisease;

    public function save(HistoryUserDisease $historyUserDisease): void;

    public function update(HistoryUserDisease $historyUserDisease): void;

    public function remove(HistoryUserDisease $historyUserDisease): void;
}
