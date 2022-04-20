<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\Trip\Trip;
use TripServiceKata\Trip\TripDAO;
use TripServiceKata\Trip\TripService;
use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;

class TripServiceTest extends TestCase
{
    /**
     * @var TripService
     */
    private $tripService;

    protected function setUp(): void
    {
        $this->mockSession = $this->createMock(UserSession::class);
        $this->mockUser = $this->createMock(User::class);
        $this->mockTripDAO = $this->createMock(TripDAO::class);
    }

    /**
     * @test
     * @testdox user not logged get exception
     */
    public function testUserIsNotLogged(): void
    {
        $this->expectException(UserNotLoggedInException::class);
        $this->mockSession->method('getLoggedUser')
            ->willReturn(null);
        $service = new TripService($this->mockSession, $this->mockTripDAO);
        $service->getTripsByUser($this->mockUser);
    }

    /**
     * @test
     * @testdox $target user with empty friends
     */
    public function testEmptyFriends(): void
    {
        $expected = [];

        $loggedUser = $this->createMock(User::class);
        $loggedUser->method('getName')
            ->willReturn('rayray');
        $this->mockSession->method('getLoggedUser')
            ->willReturn($loggedUser);
        $this->mockUser->method('isFriend')
            ->willReturn(false);
        $service = new TripService($this->mockSession, $this->mockTripDAO);
        $actual = $service->getTripsByUser($this->mockUser);

        $this->assertEquals($expected, $actual);
    }

    public function testIsFriendAndGetTrips(): void
    {
        $expectedTripId = 1;

        $loggedUser = $this->createMock(User::class);
        $this->mockSession->method('getLoggedUser')
            ->willReturn($loggedUser);
        $this->mockUser->method('isFriend')
            ->willReturn(true);
        $this->mockTripDAO->method('findTripsByUser')
            ->with($loggedUser)
            ->willReturn([new Trip($expectedTripId)]);
        $service = new TripService($this->mockSession, $this->mockTripDAO);
        $actual = $service->getTripsByUser($this->mockUser)[0];

        $this->assertEquals($expectedTripId, $actual->getId());
    }
}
