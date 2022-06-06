<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Domain;

class EncodeTokenDTO
{
    /** @var string */
    private $token;
    /** @var string */
    private $expireDate;

    public function __construct(
        string $token,
        string $expireDate
    ) {
        $this->token = $token;
        $this->expireDate = $expireDate;
    }

    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'end_date' => $this->expireDate
        ];
    }
}
