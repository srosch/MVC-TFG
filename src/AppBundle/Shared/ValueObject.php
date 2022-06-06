<?php

declare(strict_types=1);

namespace AppBundle\Shared;

abstract class ValueObject
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @param ValueObject $other
     * @param bool $strictMode
     * @return bool
     */
    public function equalsTo(ValueObject $other, bool $strictMode = true): bool
    {
        if (!$strictMode) {
            return $this->value() == $other->value();
        }
        return $this->value() === $other->value();
    }
}
