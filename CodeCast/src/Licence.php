<?php 

namespace CodeCast;

class Licence
{
    protected $user;
    protected $codeCast;

    public function __construct($user, $codeCast)
    {
        $this->user = $user;
        $this->codeCast = $codeCast;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getCodeCast()
    {
        return $this->codeCast;
    }
}