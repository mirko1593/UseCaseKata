<?php 

namespace CodeCast\Gateway;

interface UserGateway
{
    public function findUser($username);

    public function save($user);
}