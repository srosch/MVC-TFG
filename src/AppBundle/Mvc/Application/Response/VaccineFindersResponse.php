<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\Vaccine;

class VaccineFindersResponse
{
    /** @var Vaccine */
    private $vaccine;

    public function __construct(
        Vaccine $vaccine
    ) {
        $this->vaccine = $vaccine;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->vaccine->getId(),
            'name' => $this->vaccine->getName(),
            'code' => $this->vaccine->getCode(),
            'description' => $this->vaccine->getDescription(),
            'vaccinationPlanMonth' => $this->vaccine->getVaccinationPlanMonth()
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
