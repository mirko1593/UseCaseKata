<?php 

namespace CodeCast;

class User
{
    protected $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }
}