<?php

declare(strict_types=1);

namespace AppBundle\Mvc\Application\Command;

use Mvc\Infrastructure\CQRS\Command\Command;

class UserPatientCreatorCommand implements Command
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
    /** @var int */
    private $sex;
    /** @var string */
    private $email;
    /** @var string */
    private $bloodType;
    /** @var string */
    private $birthDate;
    /** @var string */
    private $birthPlace;
    /** @var float */
    private $birthWeight;
    /** @var float */
    private $birthSize;
    /** @var string */
    private $birthNotes;
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
    /** @var string */
    private $cip;
    /** @var null|string */
    private $nif;

    public function __construct(
        string $userId,
        string $id,
        string $name,
        string $firstLastName,
        ?string $secondLastName,
        int $sex,
        string $email,
        string $password,
        ?string $bloodType,
        string $birthDate,
        string $birthPlace,
        float $birthWeight,
        float $birthSize,
        string $birthNotes,
        string $address,
        string $municipality,
        string $postalCode,
        ?string $telephone,
        ?string $mobilephone,
        bool $notifications,
        string $cip,
        ?string $nif
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->firstLastName = $firstLastName;
        $this->secondLastName = $secondLastName;
        $this->sex = $sex;
        $this->email = $email;
        $this->bloodType = $bloodType;
        $this->birthDate = $birthDate;
        $this->birthPlace = $birthPlace;
        $this->birthWeight = $birthWeight;
        $this->birthSize = $birthSize;
        $this->birthNotes = $birthNotes;
        $this->address = $address;
        $this->municipality = $municipality;
        $this->postalCode = $postalCode;
        $this->telephone = $telephone;
        $this->mobilephone = $mobilephone;
        $this->notifications = $notifications;
        $this->cip = $cip;
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

    public function sex(): int
    {
        return $this->sex;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function bloodType(): ?string
    {
        return $this->bloodType;
    }

    public function birthDate(): string
    {
        return $this->birthDate;
    }

    public function birthPlace(): string
    {
        return $this->birthPlace;
    }

    public function birthWeight(): float
    {
        return $this->birthWeight;
    }

    public function birthSize(): float
    {
        return $this->birthSize;
    }

    public function birthNotes(): string
    {
        return $this->birthNotes;
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

    public function cip(): string
    {
        return $this->cip;
    }

    public function nif(): ?string
    {
        return $this->nif;
    }
}
