<?php 

namespace CodeCast\Entities;

class Licence extends Entity
{
    protected $user;
    protected $codeCast;
    protected $type;
    const VIEWABLE = 'VIEWABLE';
    const DOWALOADABLE = 'DOWALOADABLE';

    public function __construct($type, $user, $codeCast)
    {
        $this->type = $type;
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

    public function isViewable()
    {
        return $this->type === self::VIEWABLE;
    }

    public function isDownloadable()
    {
        return $this->type === self::DOWALOADABLE;
    }
}