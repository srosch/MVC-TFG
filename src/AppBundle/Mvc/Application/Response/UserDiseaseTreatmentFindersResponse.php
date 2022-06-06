<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\UserDiseaseTreatment;

class UserDiseaseTreatmentFindersResponse
{
    /** @var UserDiseaseTreatment */
    private $userDiseaseTreatment;

    public function __construct(
        UserDiseaseTreatment $userDiseaseTreatment
    ) {
        $this->userDiseaseTreatment = $userDiseaseTreatment;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->userDiseaseTreatment->getId(),
            'initDate' => $this->userDiseaseTreatment->getInitDate(),
            'endDate' => $this->userDiseaseTreatment->getEndDate(),
            'notes' => $this->userDiseaseTreatment->getNotes()
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
