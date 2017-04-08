<?php 

use CodeCast\Gateway\UserGateway;

class InMemoryUserGateway implements UserGateway
{
    protected $users;

    public function __construct()
    {
        $this->users = collect();
    }

    public function findUser($username)
    {
        return $this->users->filter(function ($user) use ($username) {
            return $user->getUsername() === $username;
        })->first();
    }

    public function save($user)
    {
        if (is_null($user->getId())) {
            $this->establishId($user);
        }
        
        return $this->users[] = $user;
    }

    protected function establishId(&$entity)
    {
        $entity->setId($this->randomId());
    }

    protected function randomId($length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['=', '+', '-'], '', base64_encode($bytes)), 0, $size);
        }

        return $string;  
    }    
}