<?php 

namespace CodeCast;

class NullCodeCast extends Entity
{
    public function getTitle()
    {
        return 'Not-Found';
    }

    public function getFormattedDate()
    {
        return 'Not-Found';
    }

    public function getDescription()
    {
        return 'Not-Found';
    }

    public function getPicture()
    {
        return 'Not-Found';
    }
}