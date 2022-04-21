<?php

namespace TripServiceKata\User;

use TripServiceKata\Trip\Trip;

class User
{
    private $trips;
    private $friends;
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
        $this->trips = [];
        $this->friends = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTrips()
    {
        return $this->trips;
    }

    public function getFriends()
    {
        return $this->friends;
    }

    public function addFriend(User $user)
    {
        $this->friends[] = $user;
    }

    public function isFriend(User $user): bool
    {
        $firendName = $user->getName();
        foreach ($this->getFriends() as $friend) {
            if ($friend->getName() == $firendName) {
                return true;
            }
        }

        return false;
    }

    public function addTrip(Trip $trip)
    {
        $this->trips[] = $trip;
    }
}
