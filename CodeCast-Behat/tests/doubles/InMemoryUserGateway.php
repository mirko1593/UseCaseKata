<?php 

use CodeCast\Gateway\UserGateway;

class InMemoryUserGateway implements UserGateway
{
    protected $users;

    public function __construct()
    {
        $this->users = [];
    }

    public function findUser($username)
    {

    }

    public function save($user)
    {
        $this->users[] = $user;
    }
}