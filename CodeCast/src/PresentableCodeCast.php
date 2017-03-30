<?php 

namespace CodeCast;

class PresentableCodeCast
{
    public $isViewable;

    public $title;

    public $publicationDate;

    public $picture;

    public $description;

    public $isDownloadable;

    public function toArray()
    {
        return [
            'title' => $this->title, 
            'publicationDate' => $this->publicationDate,
            'picture' => $this->picture, 
            'description' => $this->description, 
            'isViewable' => $this->isViewable, 
            'isDownloadable' => $this->isDownloadable
        ];
    }
}