<?php 

namespace CodeCast\Gateway;

interface UserGateway
{
    public function save($user);

    public function findUser($username);
}