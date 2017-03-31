<?php 

namespace CodeCast\Entities;

class CodeCast extends Entity
{
    protected $title;

    protected $publicationDate;

    protected $permalink;

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

    public function getFormattedDate($format = 'Y-m-d')
    {
        return $this->getPublicationDate()->format($format);
    }

    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;
    }

    public function getPermalink()
    {
        return $this->permalink;
    }
}