<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class UserDocumentCreatorPostValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection([
            'patient' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'type' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'date' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'notes' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'base64' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'name' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]
        ]);
    }
}
