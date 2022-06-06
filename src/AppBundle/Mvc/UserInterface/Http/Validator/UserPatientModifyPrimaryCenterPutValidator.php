<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class UserPatientModifyPrimaryCenterPutValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection([
            'patientId' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'doctor' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'nurse' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'primaryCenter' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]
        ]);
    }
}
