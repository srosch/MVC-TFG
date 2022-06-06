<?php declare(strict_types=1);

namespace Mvc\Infrastructure\Doctrine;

use AppBundle\Mvc\Exceptions\ScheduleNotFoundException;
use AppBundle\Mvc\Exceptions\UserNotFoundException;
use MongoDB\BSON\ObjectId;
use Mvc\Domain\Repository\ScheduleRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\Schedule;
use Mvc\Domain\User;


class DoctrineScheduleRepository extends DoctrineRepository implements ScheduleRepository
{
    /** @throws ScheduleNotFoundException */
    public function find(string $id): Schedule
    {
        $schedule = $this->repository()->find($id);
        if ($schedule === null || !$schedule instanceof Schedule) {
            throw new ScheduleNotFoundException(['id' => $id]);
        }
        return $schedule;
    }

    /** @return Schedule[] */
    public function findAllByUser(string $id): array
    {
        return $this->repository()->findBy(
            [
                'patient' => new ObjectId($id)
            ]
        );
    }

    public function update(Schedule $schedule): void
    {
        $this->documentManager->persist($schedule);
        $this->documentManager->flush($schedule);
    }

    public function save(Schedule $schedule): void
    {
        $this->update($schedule);
    }

    public function remove(Schedule $schedule): void
    {
        $this->documentManager->remove($schedule);
        $this->documentManager->flush($schedule);
    }

    protected function repositoryClassName(): string
    {
        return Schedule::class;
    }
}
