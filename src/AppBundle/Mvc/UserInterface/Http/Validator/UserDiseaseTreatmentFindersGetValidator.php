<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class UserDiseaseTreatmentFindersGetValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection([
            'historyUserDiseaseId' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]
        ]);
    }
}
