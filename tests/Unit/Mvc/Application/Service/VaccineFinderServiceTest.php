<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Application\Service;

use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\DiseaseFindersQuery;
use Mvc\Application\Query\VaccineFindersQuery;
use Mvc\Application\Service\DiseaseFindersService;
use Mvc\Application\Service\VaccineFindersService;
use Mvc\Domain\Disease;
use Mvc\Domain\Repository\DiseaseRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\Repository\VaccineRepository;
use Mvc\Domain\User;
use Mvc\Domain\Vaccine;
use Prophecy\Prophecy\ObjectProphecy;
use Tests\Unit\Mvc\Domain\DiseaseMother;
use Tests\Unit\Mvc\Domain\IdMother;
use Tests\Unit\Mvc\Domain\VaccineMother;
use Tests\Unit\Shared\UnitTestCase;

class VaccineFinderServiceTest extends UnitTestCase
{
    /** @var ObjectProphecy|Vaccine */
    private $mockVaccine;
    /** @var ObjectProphecy|User */
    private $mockUser;
    /** @var ObjectProphecy|UserRepository */
    private $mockUserRepository;
    /** @var ObjectProphecy|VaccineRepository */
    private $mockVaccineRepository;
    /** @var VaccineFindersService */
    private $sut;

    protected function setUp()
    {
        $this->mockUser = $this->mock(User::class);
        $this->mockVaccine = $this->mock(Vaccine::class);

        $this->mockVaccineRepository = $this->mock(VaccineRepository::class);
        $this->mockUserRepository = $this->mock(UserRepository::class);

        $this->sut = new VaccineFindersService(
            $this->mockUserRepository->reveal(),
            $this->mockVaccineRepository->reveal()
        );
    }

    public function test_shouldSuccessfully(): void
    {
        $userId = IdMother::random();
        $vaccine = VaccineMother::random();
        $query = new VaccineFindersQuery($userId);

        $this->mockUserRepository->find($query->userId())->shouldBeCalledOnce()->willReturn($this->mockUser);
        $this->mockUser->isHealthPersonnel()->shouldBeCalledOnce()->willReturn(true);
        $this->mockVaccineRepository->findAll()->shouldBeCalledOnce()->willReturn([$this->mockVaccine]);
        $this->mockVaccine->getId()->shouldBeCalledOnce()->willReturn($vaccine->getId());
        $this->mockVaccine->getName()->shouldBeCalledOnce()->willReturn($vaccine->getName());
        $this->mockVaccine->getDescription()->shouldBeCalledOnce()->willReturn($vaccine->getDescription());
        $this->mockVaccine->getCode()->shouldBeCalledOnce()->willReturn($vaccine->getCode());
        $this->mockVaccine->getVaccinationPlanMonth()->shouldBeCalledOnce()
            ->willReturn($vaccine->getVaccinationPlanMonth());
        $result = $this->sut->__invoke($query);
        self::assertCount(1, $result);
        self::assertArrayHasKeyAndHasEqualsValue($result[0], 'id', $vaccine->getId());
        self::assertArrayHasKeyAndHasEqualsValue($result[0], 'name', $vaccine->getName());
        self::assertArrayHasKeyAndHasEqualsValue($result[0], 'description', $vaccine->getDescription());
        self::assertArrayHasKeyAndHasEqualsValue($result[0], 'code', $vaccine->getCode());
        self::assertArrayHasKeyAndHasEqualsValue(
            $result[0],
            'vaccinationPlanMonth',
            $vaccine->getVaccinationPlanMonth()
        );
    }

    public function test_shouldSuccessfullyExceptionInvalidUser(): void
    {
        $userId = IdMother::random();
        $query = new VaccineFindersQuery($userId);

        $this->mockUserRepository->find($query->userId())->shouldBeCalledOnce()->willReturn($this->mockUser);
        $this->mockUser->isHealthPersonnel()->shouldBeCalledOnce()->willReturn(false);
        $this->expectException(UserHasNotPermissionToAccess::class);
        $this->sut->__invoke($query);
    }
}
