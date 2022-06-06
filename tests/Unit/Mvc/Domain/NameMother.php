<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Domain;

use Tests\Unit\Mother;

final class NameMother extends Mother
{
    public static function create(string $value): string
    {
        return $value;
    }

    public static function random(): string
    {
        return self::faker()->address;
    }
}
