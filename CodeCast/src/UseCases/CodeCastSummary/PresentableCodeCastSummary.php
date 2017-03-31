<?php 

namespace CodeCast\UseCases\CodeCastSummary;

class PresentableCodeCastSummary
{
    public $isViewable;

    public $title;

    public $publicationDate;

    public $picture;

    public $description;

    public $isDownloadable;

    public $permalink;

    public function toArray()
    {
        return [
            'title' => $this->title, 
            'publicationDate' => $this->publicationDate,
            'permalink' => $this->permalink,
            'picture' => $this->picture, 
            'description' => $this->description, 
            'isViewable' => $this->isViewable, 
            'isDownloadable' => $this->isDownloadable
        ];
    }
}