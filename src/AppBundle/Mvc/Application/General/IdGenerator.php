<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\General;

interface IdGenerator
{
    /** @return mixed */
    public function next();
}
