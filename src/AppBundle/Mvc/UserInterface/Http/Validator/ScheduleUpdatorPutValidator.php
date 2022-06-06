<?php

declare(strict_types=1);

namespace Mvc\UserInterface\Http\Validator;

use Symfony\Component\Validator\Constraints as Assert;

final class ScheduleUpdatorPutValidator extends Validator
{
    protected function constraints()
    {
        return new Assert\Collection([
            'scheduleId' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ],
            'date' => [
                new Assert\NotBlank(),
                new Assert\Type('string')
            ]
        ]);
    }
}
