<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Domain;

use Mvc\Domain\UserBirthData;
use Mvc\Domain\UserPrimaryCenter;
use Mvc\Domain\UserRoles;
use Mvc\Domain\User;
use Mvc\Domain\UserContactData;
use Tests\Unit\Mother;

final class UserMother extends Mother
{

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
        ?bool $sex,
        ?UserBirthData $birth,
        ?UserContactData $contact,
        ?UserPrimaryCenter $primaryCenter
    ): User {
        return User::create(
            $id,
            $name,
            $plainPassword,
            $firstLastName,
            $secondLastName,
            $email,
            $nif,
            $cip,
            $bloodType,
            $roles,
            $sex,
            $birth,
            $contact,
            $primaryCenter
        );
    }

    public static function random(): User
    {
        return self::create(
            IdMother::random(),
            'name fake',
            'test',
            'fake',
            null,
            'fake@uoc.edu',
            '999888777E',
            null,
            null,
            [User::ROLE_HEALTH_PERSONNEL],
            null,
            null,
            null,
            null
        );
    }

    public static function randomPatient(): User
    {
        return self::create(
            IdMother::random(),
            NameMother::random(),
            'test',
            'fake',
            null,
            'fake@uoc.edu',
            '999888777E',
            null,
            null,
            [User::ROLE_PATIENT],
            null,
            null,
            null,
            null
        );
    }
}
