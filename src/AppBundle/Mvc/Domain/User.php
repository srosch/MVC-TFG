<?php

declare(strict_types=1);

namespace Mvc\Domain;

use FOS\UserBundle\Model\GroupableInterface;
use FOS\UserBundle\Model\GroupInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @MongoDB\Document(collection="User")
 */
class User extends BaseUser
{
    public const ROLE_PATIENT = 'ROLE_PATIENT';
    public const ROLE_ADMINISTRATIVE = 'ROLE_ADMINISTRATIVE';
    public const ROLE_HEALTH_PERSONNEL = 'ROLE_HEALTH_PERSONNEL';

    /**
     * @MongoDB\Id(strategy="auto")
     * @var string $id
     */
    protected $id;
    /**
     * @MongoDB\Field(type="string")
     */
    private $name;
    /**
     * @MongoDB\Field(type="string")
     */
    private $firstLastName;
    /**
     * @MongoDB\Field(type="string")
     * @var null|string
     */
    private $secondLastName;
    /**
     * @MongoDB\Field(type="boolean")
     * @var int|null
     */
    private $sex;
    /**
     * @MongoDB\Field(type="string")
     */
    protected $email;

    /**
     * @MongoDB\Field(type="string")
     */
    private $nif;
    /**
     * @MongoDB\Field(type="string")
     * @var null|string
     */
    private $cip;
    /**
     * @MongoDB\Field(type="string")
     * @var null|string
     */
    private $bloodType;

    /**
     * @MongoDB\EmbedOne(targetDocument="Mvc\Domain\UserBirthData")
     * @var null|UserBirthData $birth
     */
    private $birth;
    /**
     * @MongoDB\EmbedOne(targetDocument="Mvc\Domain\UserContactData")
     * @var null|UserContactData $contact
     */
    private $contact;
    /**
     * @MongoDB\EmbedOne(targetDocument="Mvc\Domain\UserPrimaryCenter")
     * @var null|UserPrimaryCenter $primaryCenter
     */
    private $primaryCenter;

    public function __construct()
    {
        parent::__construct();
    }

    public static function build(
        string $id,
        string $name,
        string $plainPassword,
        string $firstLastName,
        ?string $secondLastName,
        string $email,
        string $nif,
        ?string $cip,
        ?string $bloodType,
        array $roles,
        ?int $sex,
        ?UserBirthData $birth,
        ?UserContactData $contact,
        ?UserPrimaryCenter $primaryCenter
    ): self {
        $entity = new self();
        $entity->setId($id);
        $entity->setName($name);
        $entity->setPlainPassword($plainPassword);
        $entity->setSex($sex);
        $entity->setFirstLastName($firstLastName);
        $entity->setSecondLastName($secondLastName);
        $entity->setEmail($email);
        $entity->setNif($nif);
        $entity->setCip($cip);
        $entity->setBloodType($bloodType);
        $entity->setRoles($roles);
        $entity->setBirth($birth);
        $entity->setContact($contact);
        $entity->setPrimaryCenter($primaryCenter);
        return $entity;
    }

    public static function create(
        string $id,
        string $name,
        string $plainPassword,
        string $firstLastName,
        ?string $secondLastName,
        string $email,
        string $nif,
        ?string $cip,
        ?string $bloodType,
        array $roles,
        ?int $sex,
        ?UserBirthData $birth,
        ?UserContactData $contact,
        ?UserPrimaryCenter $primaryCenter
    ): self {
        $entity = new self();
        $entity->setId($id);
        $entity->setName($name);
        $entity->setPlainPassword($plainPassword);
        $entity->setSex($sex);
        $entity->setFirstLastName($firstLastName);
        $entity->setSecondLastName($secondLastName);
        $entity->setEmail($email);
        $entity->setNif($nif);
        $entity->setCip($cip);
        $entity->setBloodType($bloodType);
        $entity->setRoles($roles);
        $entity->setBirth($birth);
        $entity->setContact($contact);
        $entity->setPrimaryCenter($primaryCenter);
        return $entity;
    }

    public function update(
        string $name,
        string $firstLastName,
        ?string $secondLastName,
        string $email,
        string $nif,
        ?string $cip,
        ?string $bloodType,
        array $roles,
        ?bool $sex,
        ?UserBirthData $birth,
        ?UserContactData $contact,
        ?UserPrimaryCenter $primaryCenter
    ): void {
        $this->name = $name;
        $this->firstLastName = $firstLastName;
        $this->secondLastName = $secondLastName;
        $this->email = $email;
        $this->nif = $nif;
        $this->cip = $cip;
        $this->sex = $sex;
        $this->bloodType = $bloodType;
        $this->roles = $roles;
        $this->birth = $birth;
        $this->contact = $contact;
        $this->primaryCenter = $primaryCenter;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getFirstLastName(): string
    {
        return $this->firstLastName;
    }

    public function getSecondLastName(): ?string
    {
        return $this->secondLastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getNif(): string
    {
        return $this->nif;
    }

    public function getCip(): ?string
    {
        return $this->cip;
    }

    public function getBloodType(): ?string
    {
        return $this->bloodType;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getSex(): ?int
    {
        return (int)$this->sex;
    }

    public function getBirth(): ?UserBirthData
    {
        return $this->birth;
    }

    public function getContact(): ?UserContactData
    {
        return $this->contact;
    }

    public function getPrimaryCenter(): ?UserPrimaryCenter
    {
        return $this->primaryCenter;
    }

    public function isHealthPersonnel(): bool
    {
        return in_array(self::ROLE_HEALTH_PERSONNEL, $this->roles, true);
    }

    public function isAdministrative(): bool
    {
        return in_array(self::ROLE_ADMINISTRATIVE, $this->roles, true);
    }

    public function isPatient(): bool
    {
        return in_array(self::ROLE_PATIENT, $this->roles, true);
    }

    public static function createPatient(
        string $id,
        string $name,
        string $plainPassword,
        string $firstLastName,
        ?string $secondLastName,
        string $email,
        string $nif,
        string $cip,
        ?string $bloodType,
        int $sex,
        UserBirthData $birth,
        UserContactData $contact
    ): self {
        $entity = new self();
        $entity->setId($id);
        $entity->setName($name);
        $entity->setPlainPassword($plainPassword);
        $entity->setSex($sex);
        $entity->setFirstLastName($firstLastName);
        $entity->setSecondLastName($secondLastName);
        $entity->setEmail($email);
        $entity->setNif($nif);
        $entity->setCip($cip);
        $entity->setBloodType($bloodType);
        $entity->setRoles([self::ROLE_PATIENT]);
        $entity->setBirth($birth);
        $entity->setContact($contact);
        return $entity;
    }

    public static function createAdministrative(
        string $id,
        string $name,
        string $plainPassword,
        string $firstLastName,
        ?string $secondLastName,
        string $email,
        string $nif,
        UserContactData $contact
    ): self {
        $entity = new self();
        $entity->setId($id);
        $entity->setName($name);
        $entity->setPlainPassword($plainPassword);
        $entity->setFirstLastName($firstLastName);
        $entity->setSecondLastName($secondLastName);
        $entity->setEmail($email);
        $entity->setNif($nif);
        $entity->setRoles([self::ROLE_ADMINISTRATIVE]);
        $entity->setContact($contact);
        return $entity;
    }

    public static function createHealthPersonnel(
        string $id,
        string $name,
        string $plainPassword,
        string $firstLastName,
        ?string $secondLastName,
        string $email,
        string $nif,
        UserContactData $contact
    ): self {
        $entity = new self();
        $entity->setId($id);
        $entity->setName($name);
        $entity->setPlainPassword($plainPassword);
        $entity->setFirstLastName($firstLastName);
        $entity->setSecondLastName($secondLastName);
        $entity->setEmail($email);
        $entity->setNif($nif);
        $entity->setRoles([self::ROLE_HEALTH_PERSONNEL]);
        $entity->setContact($contact);
        return $entity;
    }

    public function setPrimaryCenter(?UserPrimaryCenter $primmaryCenter): void
    {
        $this->primaryCenter = $primmaryCenter;
    }

    public function setBirthData(?UserBirthData $birthData): void
    {
        $this->birthData = $birthData;
    }

    public function setContactData(?UserContactData $contactData): void
    {
        $this->contact = $contactData;
    }

    private function setId(string $id): void
    {
        $this->id = $id;
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    private function setSex(?int $sex): void
    {
        $this->sex = $sex;
    }

    private function setFirstLastName(string $firstLastName): void
    {
        $this->firstLastName = $firstLastName;
    }

    private function setSecondLastName(?string $secondLastName): void
    {
        $this->secondLastName = $secondLastName;
    }

    private function setNif(string $nif): void
    {
        $this->nif = $nif;
    }

    private function setCip(?string $cip): void
    {
        $this->cip = $cip;
    }

    private function setBloodType(?string $bloodType): void
    {
        $this->bloodType = $bloodType;
    }

    private function setBirth(?UserBirthData $birth): void
    {
        $this->birth = $birth;
    }

    private function setContact(?UserContactData $contact): void
    {
        $this->contact = $contact;
    }
}
