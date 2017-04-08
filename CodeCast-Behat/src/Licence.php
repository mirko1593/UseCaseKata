<?php 

namespace CodeCast;

class Licence extends Entity
{
    protected $user;
    protected $codeCast;
    protected $type;
    public const VIEWABLE = 'VIEWABLE';
    public const DOWNLOADABLE = 'DOWNLOADABLE';

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
        return $this->type === static::VIEWABLE;
    }

    public function isDownloadable()
    {
        return $this->type === static::DOWNLOADABLE;
    }
}