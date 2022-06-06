<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class UserDiseaseTreatmentCreatorPostValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection([
            'historyUserDisease' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'initDate' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'endDate' => new Assert\Optional([
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]),
            'notes' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]
        ]);
    }
}
