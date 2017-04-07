<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

use CodeCast\Context;

class CodeCastSummariesUseCase
{ 
    public function summarizeCodecasts($loggedInUser, $presenter)
    {
        $codeCasts = Context::$codeCastGateway->findAllCodeCasts();

        $codeCastSummaries = $codeCasts->sort(function ($c1, $c2) {
            return $c1->getPublicationDate() <=> $c2->getPublicationDate();
        })->map(function ($codeCast) use ($loggedInUser) {
            return $this->summarizeCodecast($codeCast, $loggedInUser);
        });

        $presenter->present(new CodeCastSummariesResponseModel($codeCastSummaries));
    }

    protected function summarizeCodecast($codeCast, $loggedInUser)
    {
        $cc = new CodeCastSummary();
        $cc->title = $codeCast->getTitle();
        $cc->publicationDate = $codeCast->getFormattedDate();
        $cc->permalink = $codeCast->getPermalink();
        $cc->picture = $codeCast->getTitle();
        $cc->description = $codeCast->getTitle();
        $cc->isViewable = $this->isLicencedToViewCodeCast($loggedInUser, $codeCast);
        $cc->isDownloadable = $this->isLicencedToDownloadCodeCast($loggedInUser, $codeCast);        

        return $cc;
    }
    
    public function isLicencedToViewCodeCast($user, $codeCast)
    {
        $licences = Context::$licenceGateway->findLicenceForUserAndCodeCast($user, $codeCast);

        return $licences->filter(function ($licence) {
            return $licence->isViewable();
        })->size() > 0;
    }

    public function isLicencedToDownloadCodeCast($user, $codeCast)
    {
        $licences = Context::$licenceGateway->findLicenceForUserAndCodeCast($user, $codeCast);

        return $licences->filter(function ($licence) {
            return $licence->isDownloadable();
        })->size() > 0;
    }
}