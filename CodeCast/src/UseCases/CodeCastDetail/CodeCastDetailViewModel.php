<?php 

namespace CodeCast\UseCases\CodeCastDetail;

class CodeCastDetailViewModel
{
    public $title;

    public $publicationDate;

    public $permalink;

    public $isViewable;

    public $isDownloadable;

    public function toArray()
    {
        return [
            'title' => $this->title, 
            'publicationDate' => $this->publicationDate,
            'permalink' => $this->permalink, 
            'isViewable' => $this->isViewable, 
            'isDownloadable' => $this->isDownloadable
        ];
    }
}