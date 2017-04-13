<?php 

namespace CodeCast;

class CodeCast extends Entity
{
    protected $title;
    protected $publicationDate;
    protected $permalink;
    protected $description;
    protected $picture;

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

    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;
    }

    public function getPermalink()
    {
        return $this->permalink;
    }

    public function getDescription()
    {
        return $this->title;
    }

    public function getPicture()
    {
        return $this->title;
    }
}