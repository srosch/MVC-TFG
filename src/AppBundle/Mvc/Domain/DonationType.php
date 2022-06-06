<?php

declare(strict_types=1);

namespace Mvc\Domain;

use AppBundle\Mvc\Exceptions\InvalidDonationTypeException;
use AppBundle\Shared\ValueObjectInterface;

class DonationType implements ValueObjectInterface
{
    public const BLOOD = 'Blood';
    public const PLASM = 'Plasm';
    /** @var string $value */
    private $value;

    public function __construct(string $value)
    {
        if (!in_array($value, $this->validDonationType())) {
            throw new InvalidDonationTypeException(['type' => $value]);
        }
        $this->value = $value;
    }
    private function validDonationType(): array
    {
        return [self::BLOOD, self::PLASM];
    }

    public function isValid(string $type): bool
    {
        return in_array($type, $this->validDonationType());
    }
    public function value(): string
    {
        return $this->value;
    }
}
