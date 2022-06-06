<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Application\Service;

use AppBundle\Mvc\Application\Command\HistoryUserVaccineCreatorCommand;
use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Service\HistoryUserVaccineCreatorService;
use Mvc\Domain\HistoryUserVaccine;
use Mvc\Domain\Repository\HistoryUserVaccineRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\Repository\VaccineRepository;
use Mvc\Domain\User;
use Mvc\Domain\Vaccine;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Tests\Unit\Mvc\Domain\HistoryUserVaccineMother;
use Tests\Unit\Mvc\Domain\IdMother;
use Tests\Unit\Shared\UnitTestCase;

class HistoryUserVaccineCreatorServiceTest extends UnitTestCase
{
    /** @var ObjectProphecy|User */
    private $mockPatient;
    /** @var ObjectProphecy|User */
    private $mockUser;
    /** @var ObjectProphecy|UserRepository */
    private $mockUserRepository;
    /** @var ObjectProphecy|VaccineRepository */
    private $mockVaccineRepository;
    /** @var ObjectProphecy|HistoryUserVaccine */
    private $mockHistoryUserVaccine;
    /** @var ObjectProphecy|HistoryUserVaccineRepository */
    private $mockHistoryUserVaccineRepository;
    /** @var HistoryUserVaccineCreatorService */
    private $sut;

    protected function setUp()
    {
        $this->mockUser = $this->mock(User::class);
        $this->mockPatient = $this->mock(User::class);
        $this->mockHistoryUserVaccine = $this->mock(HistoryUserVaccine::class);

        $this->mockVaccineRepository = $this->mock(VaccineRepository::class);
        $this->mockUserRepository = $this->mock(UserRepository::class);
        $this->mockHistoryUserVaccineRepository = $this->mock(HistoryUserVaccineRepository::class);

        $this->sut = new HistoryUserVaccineCreatorService(
            $this->mockUserRepository->reveal(),
            $this->mockHistoryUserVaccineRepository->reveal(),
            $this->mockVaccineRepository->reveal()
        );
    }

    public function test_shouldSuccessfully(): void
    {
        $userId = IdMother::random();
        $history = HistoryUserVaccineMother::random();
        $command = new HistoryUserVaccineCreatorCommand(
            $userId,
            $history->getId(),
            $history->getPatient()->getId(),
            $history->getVaccine()->getId(),
            $history->getDate()->format('Y-m-d'),
            $history->getNotes()
        );

        $this->mockUserRepository->find($command->userId())->shouldBeCalledOnce()->willReturn($this->mockUser);
        $this->mockUser->isHealthPersonnel()->shouldBeCalledOnce()->willReturn(true);
        $this->mockVaccineRepository->find($command->vaccine())
            ->shouldBeCalledOnce()->willReturn($history->getVaccine());
        $this->mockUserRepository->find($command->patient())->shouldBeCalledOnce()->willReturn($history->getPatient());
        $this->mockHistoryUserVaccineRepository->save($history)->shouldBeCalledOnce();
        $this->sut->__invoke($command);
    }

    public function test_shouldSuccessfullyExceptionInvalidUser(): void
    {
        $userId = IdMother::random();
        $history = HistoryUserVaccineMother::random();
        $command = new HistoryUserVaccineCreatorCommand(
            $userId,
            $history->getId(),
            $history->getPatient()->getId(),
            $history->getVaccine()->getId(),
            $history->getDate()->format('Y-m-d'),
            $history->getNotes()
        );

        $this->mockUserRepository->find($command->userId())->shouldBeCalledOnce()->willReturn($this->mockUser);
        $this->mockUser->isHealthPersonnel()->shouldBeCalledOnce()->willReturn(false);
        $this->expectException(UserHasNotPermissionToAccess::class);
        $this->sut->__invoke($command);
    }
}
