<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Domain;

use Mvc\Domain\Vaccine;
use Tests\Unit\Mother;

final class VaccineMother extends Mother
{

    public static function create(
        string $id,
        string $name,
        string $code,
        string $description,
        array $plan
    ): Vaccine {
        return Vaccine::create(
            $id,
            $name,
            $code,
            $description,
            $plan
        );
    }

    public static function random(): Vaccine
    {
        return self::create(
            IdMother::random(),
            NameMother::random(),
            NameMother::random(),
            DescriptionMother::random(),
            []
        );
    }
}
