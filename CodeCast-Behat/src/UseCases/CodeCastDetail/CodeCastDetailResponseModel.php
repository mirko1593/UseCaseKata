<?php 

namespace CodeCast\UseCases\CodeCastDetail;

class CodeCastDetailResponseModel
{
    public $title;
    public $publicationDate;
    public $description;
    public $picture;
    public $isViewable;
    public $isDownloadable;

    public function toArray()
    {
        return [
            'title' => $this->title,
            'publicationDate' => $this->publicationDate,
            'description' => $this->description,
            'picture' => $this->picture,
            'isViewable' => $this->isViewable,
            'isDownloadable' => $this->isDownloadable
        ];
    }
}