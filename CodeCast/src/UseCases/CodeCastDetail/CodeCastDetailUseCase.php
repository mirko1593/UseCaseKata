<?php 

namespace CodeCast\UseCases\CodeCastDetail;

use CodeCast\Context;

class CodeCastDetailUseCase
{
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

    public function requestDetailByPermalink($permalink, $loggedInUser, $outputBoundary)
    {
        $codeCast = Context::$codeCastGateway->findCodeCastByPermalink($permalink);

        $cc = new CodeCastDetailResponseModel();
        $cc->title = $codeCast->getTitle();
        $cc->publicationDate = $codeCast->getFormattedDate();
        $cc->permalink = $codeCast->getPermalink();
        $cc->picture = $codeCast->getTitle();
        $cc->description = $codeCast->getTitle();
        $cc->isViewable = $this->isLicencedToViewCodeCast($loggedInUser, $codeCast);
        $cc->isDownloadable = $this->isLicencedToDownloadCodeCast($loggedInUser, $codeCast);

        $outputBoundary->present($cc);
    }
}