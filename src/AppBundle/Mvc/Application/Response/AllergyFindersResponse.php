<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Response;

use Mvc\Domain\Allergy;

class AllergyFindersResponse
{
    /** @var Allergy */
    private $allergy;

    public function __construct(
        Allergy $allergy
    ) {
        $this->allergy = $allergy;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->allergy->getId(),
            'name' => $this->allergy->getName(),
            'notes' => $this->allergy->getNotes()
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
