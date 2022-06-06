<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

class LoginPostValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection(
            [
                'email' => [
                    new Assert\NotBlank(),
                    new Assert\Required(),
                    new Assert\Type('string'),
                    new Assert\Email()
                ],
                'password' => [
                    new Assert\Required(),
                    new Assert\NotBlank(),
                    new Assert\Type('string')
                ]
            ]
        );
    }
}
