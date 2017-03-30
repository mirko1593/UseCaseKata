<?php 

trait OfCodeCasts
{
    public function makeResponseData($codeCasts)
    {
        return $codeCasts->sort(function ($c1, $c2) {
            return $c1->getPublicationDate() <=> $c2->getPublicationDate();
        })->map(function ($codeCast) {
            return [
                'title' => $codeCast->getTitle(), 
                'publicationDate' => $codeCast->getPublicationDate()->format('Y-m-d'), 
                'isViewable' => ($codeCast->getTitle() === 'Episode 2') ? true : false,
                'isDownloadable' => ($codeCast->getTitle() === 'Episode 1') ? true : false
            ];
        })->toArray();
    }
}