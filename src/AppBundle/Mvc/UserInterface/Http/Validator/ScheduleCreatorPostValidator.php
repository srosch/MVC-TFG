<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class ScheduleCreatorPostValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection([
            'patient' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'center' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'healthPersonnel' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'date' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'text' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]
        ]);
    }
}
