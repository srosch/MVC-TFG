<?php

declare(strict_types=1);

namespace Tests\Unit;

use MongoDB\BSON\ObjectId;

class ObjectIdMother extends Mother
{
    public static function create(string $value): string
    {
        return (string)new ObjectId($value);
    }

    public static function random(): string
    {
        return (string)new ObjectId();
    }
}
