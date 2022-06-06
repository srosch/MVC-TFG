<?php

declare(strict_types=1);

namespace Mvc\Domain;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class UserContactData
{
    /**
     * @MongoDB\Field(type="string")
     * @var string $email
     */
    private $email;
    /**
     * @MongoDB\Field(type="string")
     * @var string $address
     */
    private $address;
    /**
     * @MongoDB\Field(type="string")
     * @var string $municipality
     */
    private $municipality;
    /**
     * @MongoDB\Field(type="string")
     * @var string $postalCode
     */
    private $postalCode;
    /**
     * @MongoDB\Field(type="string")
     * @var null|string $telephone
     */
    private $telephone;
    /**
     * @MongoDB\Field(type="string")
     * @var null|string $mobilephone
     */
    private $mobilephone;
    /**
     * @MongoDB\Field(type="boolean")
     * @var bool $notifications
     */
    private $notifications;

    public static function build(
        string $email,
        string $address,
        string $municipality,
        string $postalCode,
        ?string $telephone,
        ?string $mobilephone,
        bool $notifications
    ): self {
        $entity = new self();
        $entity->setEmail($email);
        $entity->setAddress($address);
        $entity->setMunicipality($municipality);
        $entity->setPostalCode($postalCode);
        $entity->setTelephone($telephone);
        $entity->setMobilephone($mobilephone);
        $entity->setNotifications($notifications);
        return $entity;
    }


    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
    public function getMunicipality(): string
    {
        return $this->municipality;
    }
    public function setMunicipality(string $municipality): void
    {
        $this->municipality = $municipality;
    }
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }
    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }
    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }
    public function getMobilephone(): ?string
    {
        return $this->mobilephone;
    }
    public function setMobilephone(?string $mobilephone): void
    {
        $this->mobilephone = $mobilephone;
    }
    public function getNotifications(): bool
    {
        return $this->notifications;
    }
    public function setNotifications(bool $notifications): void
    {
        $this->notifications = $notifications;
    }
}
