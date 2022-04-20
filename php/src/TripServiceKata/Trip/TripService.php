<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{
    private UserSession $userSession;

    public function __construct(
        UserSession $userSession
    ) {
        $this->userSession = $userSession;
    }

    /**
     * @throws UserNotLoggedInException
     */
    public function getTripsByUser(User $user)
    {
        $tripList = [];
        $loggedUser = $this->userSession->getLoggedUser();
        if (empty($loggedUser)) {
            throw new UserNotLoggedInException();
        }

        if ($user->isFriend($loggedUser)) {
            $tripList = TripDAO::findTripsByUser($user);
        }
        return $tripList;
    }
}
