<?php declare(strict_types=1);
namespace Mvc\Domain\Repository;

use AppBundle\Mvc\Exceptions\ScheduleNotFoundException;
use Mvc\Domain\Allergy;
use Mvc\Domain\Schedule;

interface ScheduleRepository
{
    /** @return Schedule[] */
    public function findAllByUser(string $id): array;

    /** @throws ScheduleNotFoundException */
    public function find(string $id): Schedule;

    public function save(Schedule $schedule): void;

    public function update(Schedule $schedule): void;

    public function remove(Schedule $schedule): void;
}
