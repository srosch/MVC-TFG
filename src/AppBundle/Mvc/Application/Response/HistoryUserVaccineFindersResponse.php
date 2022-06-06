<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\HistoryUserVaccine;
use Mvc\Domain\Vaccine;

class HistoryUserVaccineFindersResponse
{
    /** @var HistoryUserVaccine */
    private $historyUserVaccine;

    public function __construct(
        HistoryUserVaccine $historyUserVaccine
    ) {
        $this->historyUserVaccine = $historyUserVaccine;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->historyUserVaccine->getId(),
            'patient' => [
                'id' =>  $this->historyUserVaccine->getPatient()->getId(),
                'name' =>  $this->historyUserVaccine->getPatient()->getName(),
                'firstLastName' =>  $this->historyUserVaccine->getPatient()->getFirstLastName()
            ],
            'vaccine' => [
                $this->historyUserVaccine->getVaccine()->getId(),
                $this->historyUserVaccine->getVaccine()->getName(),
                $this->historyUserVaccine->getVaccine()->getCode()
            ],
            'date' => $this->historyUserVaccine->getDate(),
            'notes' => $this->historyUserVaccine->getNotes()
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
