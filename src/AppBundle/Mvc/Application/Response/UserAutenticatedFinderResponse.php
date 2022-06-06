<?php

declare(strict_types=1);

namespace Mvc\Application\Response;

use Mvc\Domain\UserBirthData;
use Mvc\Domain\UserContactData;
use Mvc\Domain\UserPrimaryCenter;
use Mvc\Domain\User;

class UserAutenticatedFinderResponse
{
    /** @var User */
    private $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    public function toArray(): array
    {
        $result = [
            'id' => $this->user->getId(),
            'name' => $this->user->getName(),
            'firstLastName' => $this->user->getFirstLastName(),
            'secondLastName' => $this->user->getSecondLastName(),
            'sex' => $this->user->getSex(),
            'email' => $this->user->getEmail(),
            'nif' => $this->user->getNif(),
            'cip' => $this->user->getCip(),
            'bloodType' => $this->user->getBloodType(),
            'roles' => $this->user->getRoles(),
            'birth' => is_null($this->user->getBirth()) ? null : $this->getBirthData($this->user->getBirth()),
            'contact' => is_null($this->user->getContact()) ? null : $this->getContactData($this->user->getContact()),
            'primaryCenter' => is_null($this->user->getPrimaryCenter()) ? null
                : $this->getPrimaryCenter($this->user->getPrimaryCenter())
        ];
        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }

    private function getBirthData(UserBirthData $userBirthData): array
    {
        $result = [
            'date' => $userBirthData->getDate(),
            'place' => $userBirthData->getPlace(),
            'weight' => $userBirthData->getWeight(),
            'size' => $userBirthData->getSize(),
            'notes' => $userBirthData->getNotes()
        ];

        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }

    private function getContactData(UserContactData $userContactData): array
    {
        $result = [
            'email' => $userContactData->getEmail(),
            'address' => $userContactData->getAddress(),
            'municipality' => $userContactData->getMunicipality(),
            'postalCode' => $userContactData->getPostalCode(),
            'telephone' => $userContactData->getTelephone(),
            'mobilephone' => $userContactData->getMobilephone(),
            'notifications' => $userContactData->getNotifications()
        ];

        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }

    private function getPrimaryCenter(UserPrimaryCenter $userPrimaryCenter): array
    {
        $result = [
            'doctor' => [
                'id' => $userPrimaryCenter->getDoctor()->getId(),
                'name' => $userPrimaryCenter->getDoctor()->getName(),
                'firstLastName' => $userPrimaryCenter->getDoctor()->getFirstLastName(),
            ],
            'nurse' => [
                'id' => $userPrimaryCenter->getNurse()->getId(),
                'name' => $userPrimaryCenter->getNurse()->getName(),
                'firstLastName' => $userPrimaryCenter->getNurse()->getFirstLastName(),
            ],
            'medicalCenter' => [
                'id' => $userPrimaryCenter->getCenter()->getId(),
                'name' => $userPrimaryCenter->getCenter()->getName(),
                'address' => $userPrimaryCenter->getCenter()->getAddress()
            ]
        ];

        return array_filter($result, function ($value) {
            return $value !== null && $value !== "";
        });
    }
}
