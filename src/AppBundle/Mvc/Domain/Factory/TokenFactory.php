<?php

declare(strict_types=1);

namespace Mvc\Domain\Factory;

interface TokenFactory
{
    public function encode(string $userId): array;

    public function decode(string $token): array;
}
