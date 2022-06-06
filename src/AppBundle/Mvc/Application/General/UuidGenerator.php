<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\General;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Throwable;

class UuidGenerator implements IdGenerator
{
    /** @return string */
    public function next(): string
    {
        try {
            return RamseyUuid::uuid4()->toString();
        } catch (Throwable $exception) {
            throw new InvalidArgumentException();
        }
    }
}
