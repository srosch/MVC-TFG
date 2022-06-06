<?php
declare(strict_types=1);
namespace Mvc\Infrastructure\Doctrine;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, StringType};
use Mvc\Domain\DonationType;

class DonationTypeType extends StringType
{
    use ClosureToPHP;

    public const NAME = 'donation_type_type';

    public function convertToPHPValue($value): DonationType
    {
        return new DonationType($value);
    }

    /** @param DonationType $value */
    public function convertToDatabaseValue($value): string
    {
        return $value->value();
    }

    public function getName(): string
    {
        return static::NAME;
    }
}



