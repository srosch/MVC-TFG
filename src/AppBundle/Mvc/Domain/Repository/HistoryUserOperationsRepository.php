<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;

use Mvc\Domain\HistoryUserOperations;

interface HistoryUserOperationsRepository
{
    /** @return HistoryUserOperations[] */
    public function findAllByUserId(string $id): array;

    public function save(HistoryUserOperations $historyUserOperations): void;

    public function update(HistoryUserOperations $historyUserOperations): void;

    public function remove(HistoryUserOperations $historyUserOperations): void;
}
