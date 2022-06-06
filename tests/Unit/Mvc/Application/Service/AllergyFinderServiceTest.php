<?php

declare(strict_types=1);

namespace Tests\Unit\Mvc\Application\Service;

use AppBundle\Mvc\Exceptions\UserHasNotPermissionToAccess;
use Mvc\Application\Query\AllergyFindersQuery;
use Mvc\Application\Service\AllergyFindersService;
use Mvc\Domain\Allergy;
use Mvc\Domain\Repository\AllergyRepository;
use Mvc\Domain\Repository\UserRepository;
use Mvc\Domain\User;
use Prophecy\Prophecy\ObjectProphecy;
use Tests\Unit\Mvc\Domain\AllergyMother;
use Tests\Unit\Mvc\Domain\IdMother;
use Tests\Unit\Shared\UnitTestCase;

class AllergyFinderServiceTest extends UnitTestCase
{
    /** @var ObjectProphecy|Allergy */
    private $mockAllergy;
    /** @var ObjectProphecy|User */
    private $mockUser;
    /** @var ObjectProphecy|UserRepository */
    private $mockUserRepository;
    /** @var ObjectProphecy|AllergyRepository */
    private $mockAllergyRepository;
    /** @var AllergyFindersService */
    private $sut;

    protected function setUp()
    {
        $this->mockUser = $this->mock(User::class);
        $this->mockAllergy = $this->mock(Allergy::class);

        $this->mockAllergyRepository = $this->mock(AllergyRepository::class);
        $this->mockUserRepository = $this->mock(UserRepository::class);

        $this->sut = new AllergyFindersService(
            $this->mockUserRepository->reveal(),
            $this->mockAllergyRepository->reveal()
        );
    }

    public function test_shouldSuccessfully(): void
    {
        $userId = IdMother::random();
        $allergy = AllergyMother::random();
        $query = new AllergyFindersQuery($userId);

        $this->mockUserRepository->find($query->userId())->shouldBeCalledOnce()->willReturn($this->mockUser);
        $this->mockUser->isHealthPersonnel()->shouldBeCalledOnce()->willReturn(true);
        $this->mockAllergyRepository->findAll()->shouldBeCalledOnce()->willReturn([$this->mockAllergy]);
        $this->mockAllergy->getId()->shouldBeCalledOnce()->willReturn($allergy->getId());
        $this->mockAllergy->getName()->shouldBeCalledOnce()->willReturn($allergy->getName());
        $this->mockAllergy->getNotes()->shouldBeCalledOnce()->willReturn($allergy->getNotes());
        $result = $this->sut->__invoke($query);
        self::assertCount( 1, $result);
        self::assertArrayHasKeyAndHasEqualsValue($result[0], 'id', $allergy->getId());
        self::assertArrayHasKeyAndHasEqualsValue($result[0], 'name', $allergy->getName());
        self::assertArrayHasKeyAndHasEqualsValue($result[0], 'notes', $allergy->getNotes());
    }

    public function test_shouldSuccessfullyExceptionInvalidUser(): void
    {
        $userId = IdMother::random();
        $query = new AllergyFindersQuery($userId);

        $this->mockUserRepository->find($query->userId())->shouldBeCalledOnce()->willReturn($this->mockUser);
        $this->mockUser->isHealthPersonnel()->shouldBeCalledOnce()->willReturn(false);
        $this->expectException(UserHasNotPermissionToAccess::class);
        $this->sut->__invoke($query);
    }
}
