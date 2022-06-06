<?php

declare(strict_types=1);

namespace Tests\Unit;

use Ramsey\Uuid\Uuid as RamseyUuid;

class UuidMother extends Mother
{
    public static function create(string $value): string
    {
        return RamseyUuid::fromString($value)->toString();
    }

    public static function random(): string
    {
        return RamseyUuid::uuid4()->toString();
    }
}
