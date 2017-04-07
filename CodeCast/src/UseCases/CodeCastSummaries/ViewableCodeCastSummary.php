<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

class ViewableCodeCastSummary
{
    public $title;

    public $publicationDate;

    public $isViewable;

    public $isDownloadable;

    public function toArray()
    {
        return [
            'title' => $this->title, 
            'publicationDate' => $this->publicationDate, 
            'isViewable' => $this->isViewable, 
            'isDownloadable' => $this->isDownloadable
        ];
    }
}