<?php

declare(strict_types=1);

namespace Tests\Unit\Shared;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Throwable;

class UnitTestCase extends TestCase
{
    protected function mock(string $classOrInterface): ObjectProphecy
    {
        return $this->prophesize($classOrInterface);
    }
    /**
     * Consider using: assertArrayHasKeyAndHasEqualsAndStrictNumberValue to compare strict
     * @param string|int $key
     * @param mixed $value
     */
    protected function assertArrayHasKeyAndHasEqualsValue(
        array $arr,
        $key,
        $value,
        string $message = ''
    ): void {
        self::assertArrayHasKey($key, $arr, $message);
        self::assertEquals($value, $arr[$key], $message);
    }
    /**
     * @param string|int $key
     * @param mixed $value
     */
    protected function assertArrayHasKeyAndHasEqualsAndStrictNumberValue(
        array $arr,
        $key,
        $value,
        string $message = '',
        bool $strictType = false,
        bool $ignoreDecimalZero = true
    ): void {
        self::assertArrayHasKey($key, $arr, $message);
        $this->assertEqualsAndStrictNumberValue($value, $arr[$key], $message, $strictType, $ignoreDecimalZero);
    }
    /**
     * Only check $ignoreDecimalZero param when $strictType param is True
     * @param string|int $key
     * @param mixed $value
     */
    protected function assertEqualsAndStrictNumberValue(
        $expected,
        $actual,
        string $message = '',
        bool $strictType = false,
        bool $ignoreDecimalZero = true
    ): void {
        try {
            self::assertSame($expected, $actual, $message);
        } catch (ExpectationFailedException $exception) {
            if ((is_int($expected) || is_float($expected)) && (is_int($actual) || is_float($actual))) {
                if ($strictType && !$ignoreDecimalZero) {
                    throw $exception;
                } elseif ($ignoreDecimalZero && $expected == $actual) {
                    return;
                } elseif (!$ignoreDecimalZero && $expected === $actual) {
                    return;
                }
            }

            throw $exception;
        }
    }
    /** @deprecated */
    protected function assertEqualsArray(array $expected, array $actual): void
    {
        static::assertEquals(0, count(array_diff($expected, $actual)));
    }

}
