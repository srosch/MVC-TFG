<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\MedicalCenter;
use Mvc\Domain\User;

class MedicalCenterFindersResponse
{
    /** @var MedicalCenter */
    private $medicalCenter;

    public function __construct(
        MedicalCenter $medicalCenter
    ) {
        $this->medicalCenter = $medicalCenter;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->medicalCenter->getId(),
            'name' => $this->medicalCenter->getName(),
            'address' => $this->medicalCenter->getAddress(),
            'healthPersonnel' => $this->medicalCenter->getHealthPersonnel()
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
