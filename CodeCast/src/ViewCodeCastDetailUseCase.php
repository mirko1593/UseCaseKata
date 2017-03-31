<?php 

namespace CodeCast;

class ViewCodeCastDetailUseCase
{
    public function requestDetailsByPermalink($permalink, $loggedInUser)
    {
        $codeCast = Context::$gateway->findCodeCastByPermalink($permalink);   

        return $this->formatCodeCast($codeCast, $loggedInUser);
    }

    protected function formatCodeCast($codeCast, $loggedInUser)
    {
        $pcc = new PresentableCodeCastDetail;
        $pcc->title = $codeCast->getTitle();
        $pcc->publicationDate = $codeCast->getPublicationDate()->format('Y-m-d');
        $pcc->permalink = $codeCast->getPermalink();
        $pcc->picture = $codeCast->getTitle();
        $pcc->description = $codeCast->getTitle();
        $pcc->isViewable = $this->isLicencedToViewCodeCast($loggedInUser, $codeCast);
        $pcc->isDownloadable = $this->isLicencedToDownloadCodeCast($loggedInUser, $codeCast);

        return $pcc;        
    }

    public function isLicencedToViewCodeCast($user, $codeCast)
    {
        $licences = Context::$gateway->findLicenceForUserAndCodeCast($user, $codeCast);

        return $licences->filter(function ($licence) {
            return $licence->isViewable();
        })->size() > 0;
    }

    public function isLicencedToDownloadCodeCast($user, $codeCast)
    {
        $licences = Context::$gateway->findLicenceForUserAndCodeCast($user, $codeCast);

        return $licences->filter(function ($licence) {
            return $licence->isDownloadable();
        })->size() > 0;
    }
}