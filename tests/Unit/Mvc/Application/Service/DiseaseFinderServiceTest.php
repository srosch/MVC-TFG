<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Application\Service;

use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\DiseaseFindersQuery;
use Mvc\Application\Service\DiseaseFindersService;
use Mvc\Domain\Disease;
use Mvc\Domain\Repository\DiseaseRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\User;
use Prophecy\Prophecy\ObjectProphecy;
use Tests\Unit\Mvc\Domain\DiseaseMother;
use Tests\Unit\Mvc\Domain\IdMother;
use Tests\Unit\Shared\UnitTestCase;

class DiseaseFinderServiceTest extends UnitTestCase
{
    /** @var ObjectProphecy|Disease */
    private $mockDisease;
    /** @var ObjectProphecy|User */
    private $mockUser;
    /** @var ObjectProphecy|UserRepository */
    private $mockUserRepository;
    /** @var ObjectProphecy|DiseaseRepository */
    private $mockDiseaseRepository;
    /** @var DiseaseFindersService */
    private $sut;

    protected function setUp()
    {
        $this->mockUser = $this->mock(User::class);
        $this->mockDisease = $this->mock(Disease::class);

        $this->mockDiseaseRepository = $this->mock(DiseaseRepository::class);
        $this->mockUserRepository = $this->mock(UserRepository::class);

        $this->sut = new DiseaseFindersService(
            $this->mockUserRepository->reveal(),
            $this->mockDiseaseRepository->reveal()
        );
    }

    public function test_shouldSuccessfully(): void
    {
        $userId = IdMother::random();
        $disease = DiseaseMother::random();
        $query = new DiseaseFindersQuery($userId);

        $this->mockUserRepository->find($query->userId())->shouldBeCalledOnce()->willReturn($this->mockUser);
        $this->mockUser->isHealthPersonnel()->shouldBeCalledOnce()->willReturn(true);
        $this->mockDiseaseRepository->findAll()->shouldBeCalledOnce()->willReturn([$this->mockDisease]);
        $this->mockDisease->getId()->shouldBeCalledOnce()->willReturn($disease->getId());
        $this->mockDisease->getName()->shouldBeCalledOnce()->willReturn($disease->getName());
        $this->mockDisease->getDescription()->shouldBeCalledOnce()->willReturn($disease->getDescription());
        $result = $this->sut->__invoke($query);
        self::assertCount(1, $result);
        self::assertArrayHasKeyAndHasEqualsValue($result[0], 'id', $disease->getId());
        self::assertArrayHasKeyAndHasEqualsValue($result[0], 'name', $disease->getName());
        self::assertArrayHasKeyAndHasEqualsValue($result[0], 'description', $disease->getDescription());
    }

    public function test_shouldSuccessfullyExceptionInvalidUser(): void
    {
        $userId = IdMother::random();
        $query = new DiseaseFindersQuery($userId);

        $this->mockUserRepository->find($query->userId())->shouldBeCalledOnce()->willReturn($this->mockUser);
        $this->mockUser->isHealthPersonnel()->shouldBeCalledOnce()->willReturn(false);
        $this->expectException(UserHasNotPermissionToAccess::class);
        $this->sut->__invoke($query);
    }
}
