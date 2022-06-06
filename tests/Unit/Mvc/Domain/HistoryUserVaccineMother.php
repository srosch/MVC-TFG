<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Domain;

use Mvc\Domain\HistoryUserVaccine;
use Mvc\Domain\User;
use Mvc\Domain\Vaccine;
use Tests\Unit\Mother;

final class HistoryUserVaccineMother extends Mother
{

    public static function create(
        string $id,
        User $user,
        Vaccine $vaccine,
        \DateTimeImmutable $date,
        string $notes
    ): HistoryUserVaccine {
        return HistoryUserVaccine::create(
            $id,
            $user,
            $vaccine,
            $date,
            $notes
        );
    }

    public static function random(): HistoryUserVaccine
    {
        return self::create(
            IdMother::random(),
            UserMother::randomPatient(),
            VaccineMother::random(),
            new \DateTimeImmutable('2022-05-16'),
            DescriptionMother::random()
        );
    }
}
