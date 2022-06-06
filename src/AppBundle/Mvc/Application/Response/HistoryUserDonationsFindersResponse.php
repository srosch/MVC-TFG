<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\HistoryUserDonations;

class HistoryUserDonationsFindersResponse
{
    /** @var HistoryUserDonations */
    private $historyUserDonations;

    public function __construct(
        HistoryUserDonations $historyUserDonations
    ) {
        $this->historyUserDonations = $historyUserDonations;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->historyUserDonations->getId(),
            'patient' => [
                'id' =>  $this->historyUserDonations->getPatient()->getId(),
                'name' =>  $this->historyUserDonations->getPatient()->getName(),
                'firstLastName' =>  $this->historyUserDonations->getPatient()->getFirstLastName()
            ],
            'type' => $this->historyUserDonations->getType()->value(),
            'date' => $this->historyUserDonations->getDate(),
            'notes' => $this->historyUserDonations->getNotes()
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
