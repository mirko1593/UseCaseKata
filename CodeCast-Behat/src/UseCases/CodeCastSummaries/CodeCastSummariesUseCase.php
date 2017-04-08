<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

use CodeCast\Application;

class CodeCastSummariesUseCase
{
    public function summarizeCodeCasts($loggedInUser, $presenter)
    {
        $codeCasts = Application::$codeCastGateway->findAllCodeCasts();

        $codeCastSummaries = $codeCasts->map(function ($codeCast) use ($loggedInUser) {
            return $this->summarizeCodeCast($loggedInUser, $codeCast);
        });

        $responseModel = new CodeCastSummariesResponseModel;
        $responseModel->setCodeCastSummaries($codeCastSummaries);
        $presenter->present($responseModel);
    }

    protected function summarizeCodeCast($user, $codeCast)
    {
        $ccs = new CodeCastSummary;
        $ccs->title = $codeCast->getTitle();
        $ccs->publicationDate = $codeCast->getFormattedDate();
        $ccs->isViewable = $this->isLicencedToViewCodeCast($user, $codeCast);

        return $ccs;
    }

    public function isLicencedToViewCodeCast($user, $codeCast)
    {
        $licences = Application::$licenceGateway->findLicenceByUserAndCodeCast($user, $codeCast);

        return $licences->filter(function ($licence) {
            return $licence->isViewable();
        })->size() > 0;
    }

    public function isLicencedToDownloadCodeCast($user, $codeCast)
    {
        $licences = Application::$licenceGateway->findLicenceByUserAndCodeCast($user, $codeCast);

        return $licences->filter(function ($licence) {
            return $licence->isDownloadable();
        })->size() > 0;
    }    
}