<?php 

namespace CodeCast\UseCases\CodeCastDetail;

use CodeCast\Application;

class CodeCastDetailUseCase implements CodeCastDetailInputBoundary
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