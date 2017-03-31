<?php 

namespace CodeCast\Entities;

class User extends Entity
{
    protected $username;
    protected $id;

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }
}