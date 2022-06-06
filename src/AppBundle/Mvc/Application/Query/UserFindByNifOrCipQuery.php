<?php

declare(strict_types=1);

namespace Mvc\Application\Query;

use Mvc\Infrastructure\CQRS\Query\Query;

class UserFindByNifOrCipQuery implements Query
{
    /** @var string */
    private $userId;
    /** @var string */
    private $nifOrCip;

    public function __construct(
        string $userId,
        string $nifOrCip
    ) {
        $this->userId = $userId;
        $this->nifOrCip = $nifOrCip;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function nifOrCip(): string
    {
        return $this->nifOrCip;
    }
}
