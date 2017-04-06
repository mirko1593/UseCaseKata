<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

use CodeCast\Context;

class CodeCastSummariesUseCase
{ 
    public function presentCodeCast($loggedInUser)
    {
        $codeCasts = Context::$codeCastGateway->findAllCodeCasts();

        return new CodeCastSummariesResponseModel(
            $codeCasts->sort(function ($c1, $c2) {
                return $c1->getPublicationDate() <=> $c2->getPublicationDate();
            })->map(function ($codeCast) use ($loggedInUser) {
                return $this->formatSummaryField($codeCast, $loggedInUser);
            })
        );
    }

    protected function formatSummaryField($codeCast, $loggedInUser)
    {
        $pcc = new PresentableCodeCastSummary();
        $pcc->title = $codeCast->getTitle();
        $pcc->publicationDate = $codeCast->getFormattedDate();
        $pcc->permalink = $codeCast->getPermalink();
        $pcc->picture = $codeCast->getTitle();
        $pcc->description = $codeCast->getTitle();
        $pcc->isViewable = $this->isLicencedToViewCodeCast($loggedInUser, $codeCast);
        $pcc->isDownloadable = $this->isLicencedToDownloadCodeCast($loggedInUser, $codeCast);

        return $pcc;
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

    public function summarizeCodecasts($loggedInUser, $presenter)
    {
        $codeCasts = Context::$codeCastGateway->findAllCodeCasts();

        $codeCastSummariesResponseModel = new CodeCastSummariesResponseModel(
            $codeCasts->sort(function ($c1, $c2) {
                return $c1->getPublicationDate() <=> $c2->getPublicationDate();
            })->map(function ($codeCast) use ($loggedInUser) {
                return $this->formatSummaryField($codeCast, $loggedInUser);
            })
        );
        $presenter->present($codeCastSummariesResponseModel);
    }
}