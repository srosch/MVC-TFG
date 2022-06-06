<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class MedicalCenterUpdatorPutValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection([
            'medicalCenterId' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'name' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'address' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'healthPersonnel' => new Assert\All([
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]),
        ]);
    }
}
