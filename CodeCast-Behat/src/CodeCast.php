<?php 

namespace CodeCast;

class CodeCast extends Entity
{
    protected $title;
    protected $publicationDate;

    public function __construct($title, $publicationDate)
    {
        $this->title = $title;
        $this->publicationDate = $publicationDate;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getFormattedDate()
    {
        return $this->publicationDate->format('Y-m-d');
    }
}