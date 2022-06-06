<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;


use Mvc\Domain\HistoryUserDonations;

interface HistoryUserDonationsRepository
{
    /** @return HistoryUserDonations[] */
    public function findAllByUserId(string $id): array;

    public function save(HistoryUserDonations $historyUserDonations): void;

    public function update(HistoryUserDonations $historyUserDonations): void;

    public function remove(HistoryUserDonations $historyUserDonations): void;
}
