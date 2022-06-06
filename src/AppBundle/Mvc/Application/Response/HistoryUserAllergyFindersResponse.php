<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\Allergy;
use Mvc\Domain\HistoryUserAllergy;

class HistoryUserAllergyFindersResponse
{
    /** @var HistoryUserAllergy */
    private $historyUserAllergy;

    public function __construct(
        HistoryUserAllergy $historyUserAllergy
    ) {
        $this->historyUserAllergy = $historyUserAllergy;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->historyUserAllergy->getId(),
            'patient' => [
                'id' =>  $this->historyUserAllergy->getPatient()->getId(),
                'name' =>  $this->historyUserAllergy->getPatient()->getName(),
                'firstLastName' =>  $this->historyUserAllergy->getPatient()->getFirstLastName()
            ],
            'allergy' => [
                $this->historyUserAllergy->getAllergy()->getId(),
                $this->historyUserAllergy->getAllergy()->getName()
            ],
            'date' => $this->historyUserAllergy->getDate(),
            'notes' => $this->historyUserAllergy->getNotes()
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
