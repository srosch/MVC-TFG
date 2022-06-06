<?php

declare(strict_types=1);

namespace Tests\Unit;

use Faker\Factory;
use Faker\Generator;
use Faker\Provider\Color;
use Faker\Provider\DateTime;
use Faker\Provider\es_ES\{Address, Company, Person, PhoneNumber, Payment};
use Faker\Provider\Internet;
use Faker\Provider\Lorem;
use Faker\Provider\Miscellaneous;

class Mother
{
    /** @var null|Generator $faker */
    private static $faker = null;

    protected static function faker(): Generator
    {
        if (!is_null(self::$faker)) {
            return self::$faker;
        }
        self::$faker = Factory::create();
        self::$faker->addProvider(new DateTime(self::$faker));
        self::$faker->addProvider(new Internet(self::$faker));
        self::$faker->addProvider(new Miscellaneous(self::$faker));
        self::$faker->addProvider(new PhoneNumber(self::$faker));
        self::$faker->addProvider(new Lorem(self::$faker));
        self::$faker->addProvider(new Color(self::$faker));
        return self::$faker;
    }
}
