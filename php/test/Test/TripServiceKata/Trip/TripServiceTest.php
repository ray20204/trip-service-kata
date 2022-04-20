<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
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
        $service = new TripService($this->mockSession);
        $service->getTripsByUser($this->mockUser);
    }
}
