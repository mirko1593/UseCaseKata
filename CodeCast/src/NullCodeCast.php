<?php 

namespace CodeCast;

class NullCodeCast extends CodeCast
{
    public function __construct()
    {
        parent::__construct('Not Found', 'Not Found');
        $this->setPermalink('not-found');
    }

    public function getFormattedDate($format = 'Y-m-d')
    {
        return 'Not Found';
    }
}