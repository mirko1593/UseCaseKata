<?php 

trait OfCodeCasts
{
    public function makeResponseData($codeCasts)
    {
        return $codeCasts->map(function ($codeCast) {
            return [
                'title' => $codeCast->getTitle(), 
                'publicationDate' => $codeCast->getPublicationDate(), 
                'isViewable' => ($codeCast->getTitle() === 'Episode 2') ? true : false,
                'isDownloadable' => ($codeCast->getTitle() === 'Episode 1') ? true : false
            ];
        })->toArray();
    }
}