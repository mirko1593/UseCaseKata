<?php 

trait CodeCastDetails
{
    public function makeCodeCastDetail($codeCast)
    {
        return [
            'title' => $codeCast->getTitle(), 
            'publicationDate' => $codeCast->getPublicationDate()->format('Y-m-d'), 
            'permalink' => $codeCast->getPermalink(), 
            'isViewable' => false, 
            'isDownloadable' => false
        ];
    }
}