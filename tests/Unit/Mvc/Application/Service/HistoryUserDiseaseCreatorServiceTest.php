<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\HistoryUserAllergyCreatorCommand;
use AppBundle\Mvc\Application\Command\HistoryUserVaccineCreatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Service\HistoryUserAllergyCreatorService;
use Mvc\Application\Service\HistoryUserVaccineCreatorService;
use Mvc\Domain\HistoryUserAllergy;
use Mvc\Domain\HistoryUserVaccine;
use Mvc\Domain\Repository\AllergyRepository;
use Mvc\Domain\Repository\HistoryUserAllergyRepository;
use Mvc\Domain\Repository\HistoryUserVaccineRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\Repository\VaccineRepository;
use Mvc\Domain\User;
use Mvc\Domain\Vaccine;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Tests\Unit\Mvc\Domain\HistoryUserAllergyMother;
use Tests\Unit\Mvc\Domain\HistoryUserVaccineMother;
use Tests\Unit\Mvc\Domain\IdMother;
use Tests\Unit\Shared\UnitTestCase;

class HistoryUserDiseaseCreatorServiceTest extends UnitTestCase
{
    /** @var ObjectProphecy|User */
    private $mockPatient;
    /** @var ObjectProphecy|User */
    private $mockUser;
    /** @var ObjectProphecy|UserRepository */
    private $mockUserRepository;
    /** @var ObjectProphecy|AllergyRepository */
    private $mockAllergyRepository;
    /** @var ObjectProphecy|HistoryUserAllergy */
    private $mockHistoryUserAllergy;
    /** @var ObjectProphecy|HistoryUserAllergyRepository */
    private $mockHistoryUserAllergyRepository;
    /** @var HistoryUserAllergyCreatorService */
    private $sut;

    protected function setUp()
    {
        $this->mockUser = $this->mock(User::class);
        $this->mockPatient = $this->mock(User::class);
        $this->mockHistoryUserAllergy = $this->mock(HistoryUserAllergy::class);

        $this->mockAllergyRepository = $this->mock(AllergyRepository::class);
        $this->mockUserRepository = $this->mock(UserRepository::class);
        $this->mockHistoryUserAllergyRepository = $this->mock(HistoryUserAllergyRepository::class);

        $this->sut = new HistoryUserAllergyCreatorService(
            $this->mockUserRepository->reveal(),
            $this->mockHistoryUserAllergyRepository->reveal(),
            $this->mockAllergyRepository->reveal()
        );
    }

    public function test_shouldSuccessfully(): void
    {
        $userId = IdMother::random();
        $history = HistoryUserAllergyMother::random();
        $command = new HistoryUserAllergyCreatorCommand(
            $userId,
            $history->getId(),
            $history->getPatient()->getId(),
            $history->getAllergy()->getId(),
            $history->getDate()->format('Y-m-d'),
            $history->getNotes()
        );

        $this->mockUserRepository->find($command->userId())->shouldBeCalledOnce()->willReturn($this->mockUser);
        $this->mockUser->isHealthPersonnel()->shouldBeCalledOnce()->willReturn(true);
        $this->mockAllergyRepository->find($command->allergy())
            ->shouldBeCalledOnce()->willReturn($history->getAllergy());
        $this->mockUserRepository->find($command->patient())->shouldBeCalledOnce()->willReturn($history->getPatient());
        $this->mockHistoryUserAllergyRepository->save($history)->shouldBeCalledOnce();
        $this->sut->__invoke($command);
    }

    public function test_shouldSuccessfullyExceptionInvalidUser(): void
    {
        $userId = IdMother::random();
        $history = HistoryUserAllergyMother::random();
        $command = new HistoryUserAllergyCreatorCommand(
            $userId,
            $history->getId(),
            $history->getPatient()->getId(),
            $history->getAllergy()->getId(),
            $history->getDate()->format('Y-m-d'),
            $history->getNotes()
        );

        $this->mockUserRepository->find($command->userId())->shouldBeCalledOnce()->willReturn($this->mockUser);
        $this->mockUser->isHealthPersonnel()->shouldBeCalledOnce()->willReturn(false);
        $this->expectException(UserHasNotPermissionToAccess::class);
        $this->sut->__invoke($command);
    }
}
