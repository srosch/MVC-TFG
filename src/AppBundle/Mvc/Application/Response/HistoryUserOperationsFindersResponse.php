<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\Notes;
use Mvc\Domain\HistoryUserOperations;
use Mvc\Domain\HistoryUserVaccine;
use Mvc\Domain\Vaccine;

class HistoryUserOperationsFindersResponse
{
    /** @var HistoryUserOperations */
    private $historyUserOperations;

    public function __construct(
        HistoryUserOperations $historyUserOperations
    ) {
        $this->historyUserOperations = $historyUserOperations;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->historyUserOperations->getId(),
            'patient' => [
                'id' =>  $this->historyUserOperations->getPatient()->getId(),
                'name' =>  $this->historyUserOperations->getPatient()->getName(),
                'firstLastName' =>  $this->historyUserOperations->getPatient()->getFirstLastName()
            ],
            'date' => $this->historyUserOperations->getDate(),
            'notes' => $this->getNotes($this->historyUserOperations->getNotes())
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
