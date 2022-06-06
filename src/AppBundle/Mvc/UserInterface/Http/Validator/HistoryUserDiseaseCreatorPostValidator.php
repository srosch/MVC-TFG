<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class HistoryUserDiseaseCreatorPostValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection([
            'patient' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'disease' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'initDate' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'notes' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]
        ]);
    }
}
