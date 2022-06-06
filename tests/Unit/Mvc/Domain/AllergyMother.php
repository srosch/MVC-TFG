<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Domain;

use Mvc\Domain\Allergy;
use Tests\Unit\Mother;

final class AllergyMother extends Mother
{

    public static function create(
        string $id,
        string $name,
        string $notes
    ): Allergy {
        return Allergy::create(
            $id,
            $name,
            $notes
        );
    }

    public static function random(): Allergy
    {
        return self::create(
            IdMother::random(),
            NameMother::random(),
            DescriptionMother::random()
        );
    }
}
