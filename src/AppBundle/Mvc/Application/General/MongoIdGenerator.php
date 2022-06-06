<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\General;

use MongoDB\BSON\ObjectId;

class MongoIdGenerator implements IdGenerator
{
    /** @return string */
    public function next(): string
    {
        return (string) new ObjectId();
    }
}
