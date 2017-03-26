<?php 

namespace CodeCast;

class CodeCast
{
    protected $title;

    protected $publicationDate;

    public function __construct($title, $publicationDate)
    {
        $this->title = $title;
        $this->publicationDate = $publicationDate;
    }
}