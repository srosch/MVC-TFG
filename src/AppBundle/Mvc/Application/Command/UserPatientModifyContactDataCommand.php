<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class UserPatientModifyContactDataCommand implements Command
{
    /** @var string */
    private $email;
    /** @var string */
    private $address;
    /** @var string */
    private $municipality;
    /** @var string */
    private $postalCode;
    /** @var null|string */
    private $telephone;
    /** @var null|string */
    private $mobilephone;
    /** @var bool */
    private $notifications;

    public function __construct(
        string $userId,
        string $id,
        string $email,
        string $address,
        string $municipality,
        string $postalCode,
        ?string $telephone,
        ?string $mobilephone,
        bool $notifications
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->email = $email;
        $this->address = $address;
        $this->municipality = $municipality;
        $this->postalCode = $postalCode;
        $this->telephone = $telephone;
        $this->mobilephone = $mobilephone;
        $this->notifications = $notifications;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function municipality(): string
    {
        return $this->municipality;
    }

    public function postalCode(): string
    {
        return $this->postalCode;
    }

    public function telephone(): ?string
    {
        return $this->telephone;
    }

    public function mobilephone(): ?string
    {
        return $this->mobilephone;
    }

    public function notifications(): bool
    {
        return $this->notifications;
    }
}
