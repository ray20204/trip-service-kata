<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\Trip\TripService;
use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;

class UserTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        $this->user = new User('ray');
    }

    public function testGetFriends(): void
    {
        $expected = 'rayray';
        $friend = $this->createMock(User::class);
        $friend->method('getName')->willReturn($expected);
        $this->user->addFriend($friend);
        $actual = $this->user->getFriends()[0];

        $this->assertEquals($expected, $actual->getName());
    }

    public function testGetTrips(): void
    {
        $expected = 'rayray';
        $friend = $this->createMock(User::class);
        $friend->method('getName')->willReturn($expected);
        $this->user->addFriend($friend);
        $actual = $this->user->getFriends()[0];

        $this->assertEquals($expected, $actual->getName());
    }

    public function testIsFriend(): void
    {
        $expected = 'rayray';
        $friend = $this->createMock(User::class);
        $friend->method('getName')->willReturn($expected);
        $this->user->addFriend($friend);
        $actual = $this->user->isFriend($friend);

        $this->assertTrue($actual);
    }
}
