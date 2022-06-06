<?php

declare(strict_types=1);

namespace Mvc\Domain;

use DateTimeImmutable;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Mvc\Domain\MedicalCenter;
use Mvc\Domain\User;

/**
 * @MongoDB\EmbeddedDocument
 */
class UserPrimaryCenter
{
    /**
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\User", simple=true)
     * @var User $doctor
     */
    private $doctor;
    /**
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\User", simple=true)
     * @var User $nurse
     */
    private $nurse;
    /**
     * @MongoDB\ReferenceOne(targetDocument="Mvc\Domain\MedicalCenter", simple=true)
     * @var MedicalCenter $center
     */
    private $center;

    public static function build(
        User $doctor,
        User $nurse,
        MedicalCenter $center
    ): self {
        $entity = new self();
        $entity->setDoctor($doctor);
        $entity->setNurse($nurse);
        $entity->setCenter($center);
        return $entity;
    }
    public function getDoctor(): User
    {
        return $this->doctor;
    }
    public function setDoctor(User $doctor): void
    {
        $this->doctor = $doctor;
    }
    public function getNurse(): User
    {
        return $this->nurse;
    }
    public function setNurse(User $nurse): void
    {
        $this->nurse = $nurse;
    }
    public function getCenter(): MedicalCenter
    {
        return $this->center;
    }
    public function setCenter(MedicalCenter $center): void
    {
        $this->center = $center;
    }
}
