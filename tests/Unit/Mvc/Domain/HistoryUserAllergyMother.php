<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Domain;

use Mvc\Domain\Allergy;
use Mvc\Domain\HistoryUserAllergy;
use Mvc\Domain\User;
use Tests\Unit\Mother;

final class HistoryUserAllergyMother extends Mother
{

    public static function create(
        string $id,
        User $user,
        Allergy $allergy,
        \DateTimeImmutable $date,
        string $notes
    ): HistoryUserAllergy {
        return HistoryUserAllergy::create(
            $id,
            $user,
            $allergy,
            $date,
            $notes
        );
    }

    public static function random(): HistoryUserAllergy
    {
        return self::create(
            IdMother::random(),
            UserMother::randomPatient(),
            AllergyMother::random(),
            new \DateTimeImmutable('2022-05-16'),
            DescriptionMother::random()
        );
    }
}
