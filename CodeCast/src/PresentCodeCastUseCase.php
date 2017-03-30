<?php 

namespace CodeCast;

use CodeCast\{Context, PresentableCodeCast};

class PresentCodeCastUseCase
{ 
    public function presentCodeCast($loggedInUser)
    {
        $codeCasts = Context::$gateway->findAllCodeCasts();

        return $codeCasts->map(function ($codeCast) use ($loggedInUser) {
            $pcc = new PresentableCodeCast();
            $pcc->title = $codeCast->getTitle();
            $pcc->publicationDate = $codeCast->getPublicationDate();
            $pcc->picture = $codeCast->getTitle();
            $pcc->description = $codeCast->getTitle();
            $pcc->isViewable = $this->isLicencedToViewCodeCast($loggedInUser, $codeCast);
            $pcc->isDownloadable = $this->isLicencedToDownloadCodeCast($loggedInUser, $codeCast);
            return $pcc;
        });
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