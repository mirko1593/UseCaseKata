<?php 

namespace CodeCast\UseCases\CodeCastDetail;

use CodeCast\Application;
use CodeCast\UseCases\CodeCastUseCase;

class CodeCastDetailUseCase extends CodeCastUseCase implements CodeCastDetailInputBoundary
{
    public function requestDetailByPermalink($permalink, $loggedInUser, $presenter)
    {
        $codeCast = Application::$codeCastGateway->findCodeCastByPermalink($permalink);
        $responseModel = $this->formatResponseModelFields($codeCast, $loggedInUser);
        $presenter->present($responseModel);   
    }

    protected function formatResponseModelFields($codeCast, $loggedInUser)
    {
        $responseModel = new CodeCastDetailResponseModel();
        $responseModel->title = $codeCast->getTitle();
        $responseModel->publicationDate = $codeCast->getFormattedDate();
        $responseModel->description = $codeCast->getDescription();
        $responseModel->picture = $codeCast->getPicture();
        $responseModel->isViewable = $this->isLicencedToViewCodeCast($loggedInUser, $codeCast);
        $responseModel->isDownloadable = $this->isLicencedToDownloadCodeCast($loggedInUser, $codeCast);

        return $responseModel;
    } 
}