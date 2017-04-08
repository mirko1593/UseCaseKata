<?php 

namespace CodeCast;

class GateKeeper
{
    protected $loggedInUser;

    public function setLoggedInUser($user)
    {
        $this->loggedInUser = $user;
    }

    public function getLoggedInUser()
    {
        return $this->loggedInUser;
    }
}