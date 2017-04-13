<?php 

namespace CodeCast\UseCases\CodeCastDetail;

class CodeCastDetailViewModel
{
    public $title;
    public $publicationDate;
    public $description;
    public $picture;
    public $viewable;
    public $downloadable;

    public function toArray()
    {
        return [
            'title' => $this->title,
            'publicationDate' => $this->publicationDate,
            'description' => $this->description,
            'picture' => $this->picture,
            'viewable' => $this->viewable,
            'downloadable' => $this->downloadable
        ];
    }
}
