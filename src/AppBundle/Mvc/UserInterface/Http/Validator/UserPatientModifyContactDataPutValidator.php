<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class UserPatientModifyContactDataPutValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection([
            'patientId' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'email' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'address' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'municipality' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'postalCode' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'telephone' => new Assert\Optional(
                [
                    new Assert\NotBlank(),
                    new Assert\Type('string')
                ]
            ),
            'mobilephone' => new Assert\Optional(
                [
                    new Assert\NotBlank(),
                    new Assert\Type('string')
                ]
            ),
            'notifications' => new Assert\Optional(
                [
                    new Assert\Type('boolean')
                ]
            )
        ]);
    }
}
