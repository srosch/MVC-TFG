<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Domain;

use Mvc\Domain\Disease;
use Tests\Unit\Mother;

final class DiseaseMother extends Mother
{

    public static function create(
        string $id,
        string $name,
        string $description
    ): Disease {
        return Disease::create(
            $id,
            $name,
            $description
        );
    }

    public static function random(): Disease
    {
        return self::create(
            IdMother::random(),
            NameMother::random(),
            DescriptionMother::random()
        );
    }
}
