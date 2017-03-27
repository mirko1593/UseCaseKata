<?php 

namespace CodeCast;

class User
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

    public function isSame($user)
    {
        return (! is_null($this->getId())) && $this->getId() === $user->getId();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function establishId()
    {
        $this->id = $this->randomId();
        return $this;
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