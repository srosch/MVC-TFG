<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class UserPatientCreatorPostValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection([
            'name' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'password' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'firstLastName' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'secondLastName' => new Assert\Optional(
                [
                    new Assert\NotBlank(),
                    new Assert\Type('string')
                ]
            ),
            'sex' => [
                new Assert\NotBlank(),
                new Assert\Type('int')
            ],
            'email' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'bloodType' => [
                    new Assert\NotBlank(),
                    new Assert\Type('string')
                ],
            'birthDate' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'birthPlace' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'birthWeight' => [
                new Assert\NotBlank(),
                new Assert\Type('float')
            ],
            'birthSize' => [
                new Assert\NotBlank(),
                new Assert\Type('float')
            ],
            'birthNotes' => [
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
            'notifications' => [
                new Assert\NotBlank(),
                new Assert\Type('boolean')
            ],
            'cip' => [
                    new Assert\NotBlank(),
                    new Assert\Type('string')
                ],
            'nif' => new Assert\Optional(
                [
                    new Assert\NotBlank(),
                    new Assert\Type('string')
                ]
            ),
        ]);
    }
}
