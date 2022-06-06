<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\HistoryUserDisease;

class HistoryUserDiseaseFindersResponse
{
    /** @var HistoryUserDisease */
    private $historyUserDisease;

    public function __construct(
        HistoryUserDisease $historyUserDisease
    ) {
        $this->historyUserDisease = $historyUserDisease;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->historyUserDisease->getId(),
            'patient' => [
                'id' =>  $this->historyUserDisease->getPatient()->getId(),
                'name' =>  $this->historyUserDisease->getPatient()->getName(),
                'firstLastName' =>  $this->historyUserDisease->getPatient()->getFirstLastName()
            ],
            'disease' => [
                $this->historyUserDisease->getDisease()->getId(),
                $this->historyUserDisease->getDisease()->getName()
            ],
            'initDate' => $this->historyUserDisease->getInitDate(),
            'endDate' => $this->historyUserDisease->getEndDate(),
            'notes' => $this->historyUserDisease->getNotes()
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
