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

    public function getTitle()
    {
        return $this->title;
    }

    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    public function isSame($codeCast)
    {
        return $this->getTitle() === $codeCast->getTitle();
    }
}