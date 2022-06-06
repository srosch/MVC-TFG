<?php

namespace Mvc\Infrastructure\CQRS\Aggregates;

abstract class Aggregate
{
    public function __toString(): string
    {
        return (string)json_encode(get_object_vars($this));
    }
}
