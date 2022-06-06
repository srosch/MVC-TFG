<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class UserAdministrativeCreatorCommand implements Command
{
    /** @var string */
    private $userId;
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $password;
    /** @var string */
    private $firstLastName;
    /** @var null|string */
    private $secondLastName;
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
    /** @var null|string */
    private $nif;

    public function __construct(
        string $userId,
        string $id,
        string $name,
        string $firstLastName,
        ?string $secondLastName,
        string $email,
        string $password,
        string $address,
        string $municipality,
        string $postalCode,
        ?string $telephone,
        ?string $mobilephone,
        ?string $nif
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->firstLastName = $firstLastName;
        $this->secondLastName = $secondLastName;
        $this->email = $email;
        $this->address = $address;
        $this->municipality = $municipality;
        $this->postalCode = $postalCode;
        $this->telephone = $telephone;
        $this->mobilephone = $mobilephone;
        $this->nif = $nif;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function firstLastName(): string
    {
        return $this->firstLastName;
    }

    public function secondLastName(): ?string
    {
        return $this->secondLastName;
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

    public function nif(): ?string
    {
        return $this->nif;
    }
}
