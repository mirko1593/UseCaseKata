<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

use CodeCast\Application;
use CodeCast\UseCases\CodeCastUseCase;

class CodeCastSummariesUseCase extends CodeCastUseCase implements CodeCastSummariesInputBoundary
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
        $ccs->isDownloadable = $this->isLicencedToDownloadCodeCast($user, $codeCast);
        
        return $ccs;
    }  
}