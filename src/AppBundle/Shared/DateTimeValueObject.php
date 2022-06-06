<?php

declare(strict_types=1);

namespace AppBundle\Shared;

use AppBundle\Mvc\Exceptions\InvalidDateException;
use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Throwable;

class DateTimeValueObject extends ValueObject
{
    /** @var DateTimeImmutable $value */
    protected $value;

    /** @param DateTimeImmutable $value
     * @throws \Exception
     */
    public function __construct(DateTimeInterface $value)
    {
        if ($value instanceof DateTime) {
            $value = DateTimeImmutable::createFromMutable($value);
        } elseif (!($value instanceof DateTimeImmutable)) {
            $value = new DateTimeImmutable($value);
        }
        parent::__construct($value);
    }

    /** @throws InvalidDateException */
    public static function fromString(string $value, ?DateTimeZone $timezone = null): self
    {
        try {
            return new self(new DateTimeImmutable($value, $timezone));
        } catch (Throwable $exception) {
            throw new InvalidDateException(['value' => $value], $exception);
        }
    }

    /**
     * @throws \Exception
     */
    public static function fromInt(int $value, ?DateTimeZone $timezone = null): self
    {
        return new self((new DateTimeImmutable('now', $timezone))->setTimestamp($value));
    }

    /**
     * @throws \Exception
     */
    public static function now(?DateTimeZone $timezone = null): self
    {
        return new self(new DateTimeImmutable('now', $timezone));
    }

    /**
     * @throws \Exception
     */
    public static function nowWithTimeCleaned(?DateTimeZone $timezone = null): self
    {
        return new self((new DateTimeImmutable('now', $timezone))->setTime(0, 0, 0));
    }

    /** @param string|int $value */
    public static function nowModify($value, string $type, ?DateTimeZone $timezone = null): self
    {
        $datetime = self::now($timezone)->value();
        $datetime = new DateTime($datetime->format('Y-m-d H:i:s'), $datetime->getTimezone());
        $datetime->modify($value . ' ' . $type);
        return self::fromInt($datetime->getTimestamp(), $datetime->getTimezone());
    }

    public function clearTime(): self
    {
        return new self($this->value->setTime(0, 0, 0));
    }

    /** @param string $type */
    public function modify(string $type): self
    {
        $datetime = $this->value()->modify($type);
        return self::fromInt($datetime->getTimestamp(), $datetime->getTimezone());
    }

    public function toISODate(): string
    {
        return $this->value->format(DATE_ISO8601);
    }

    public function formatDate(): string
    {
        return $this->value->format('Y-m-d');
    }

    public function formatMonthly(): string
    {
        return $this->value->format('Y-m');
    }

    public function yearFormatString(): string
    {
        return $this->value->format('Y');
    }

    public function monthFormatString(): string
    {
        return $this->value->format('m');
    }

    public function diff(DateTimeValueObject $other): DateInterval
    {
        return $this->value()->diff($other->value());
    }

    public function getTimestamp(): int
    {
        return $this->value->getTimestamp();
    }

    public function value(): DateTimeInterface
    {
        return parent::value();
    }

    public function equalsToNotStrict(ValueObject $other): bool
    {
        return parent::equalsTo($other, false);
    }
}
