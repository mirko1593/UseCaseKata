<?php 

namespace CodeCast;

class GateKeeper
{
    protected $loggedInUser;

    public function __construct($loggedInUser = null)
    {
        $this->loggedInUser = $loggedInUser;
    }

    public function setLoggedInUser($loggedInUser)
    {
        $this->loggedInUser = $loggedInUser;
    }

    public function getLoggedInUser()
    {
        return $this->loggedInUser;
    }

}