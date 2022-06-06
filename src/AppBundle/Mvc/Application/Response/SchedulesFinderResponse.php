<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\Notes;
use Mvc\Domain\Schedule;

class SchedulesFinderResponse
{
    /** @var Schedule */
    private $schedule;

    public function __construct(
        Schedule $schedule
    ) {
        $this->schedule = $schedule;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->schedule->getId(),
            'patient' => [
                'id' =>  $this->schedule->getPatient()->getId(),
                'name' =>  $this->schedule->getPatient()->getName(),
                'firstLastName' =>  $this->schedule->getPatient()->getFirstLastName()
            ],
            'healthPersonnel' => [
                'id' =>  $this->schedule->getHealthPersonnel()->getId(),
                'name' =>  $this->schedule->getHealthPersonnel()->getName(),
                'firstLastName' =>  $this->schedule->getHealthPersonnel()->getFirstLastName()
            ],
            'date' => $this->schedule->getDate(),
            'notes' => $this->getNotes($this->schedule->getNotes())
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
    /** @var Notes[] $notes */
    private function getNotes(array $notes): array
    {
        return array_map(static function (Notes $note) {
            $result = [
                'date' => $note->getDate(),
                'text' => $note->getText(),
                'healthPersonnel' => [
                    'id' => $note->getHealthPersonnel()->getId(),
                    'name' => $note->getHealthPersonnel()->getName(),
                    'firstLastName' => $note->getHealthPersonnel()->getFirstLastName()
                ]
            ];
            return array_filter($result, function ($value) {
                return $value !== null && $value !== "";
            });
        }, $notes);
    }
}
