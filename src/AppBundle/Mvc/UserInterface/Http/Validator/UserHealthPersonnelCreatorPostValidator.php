<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class UserHealthPersonnelCreatorPostValidator extends Validator
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
            'nif' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]
        ]);
    }
}
