<?php 

namespace CodeCast\UseCases;

use CodeCast\Application;

abstract class CodeCastUseCase
{
    public static function isLicencedToViewCodeCast($user, $codeCast)
    {
        $licences = Application::$licenceGateway->findLicenceByUserAndCodeCast($user, $codeCast);

        return $licences->filter(function ($licence) {
            return $licence->isViewable();
        })->size() > 0;
    }

    public static function isLicencedToDownloadCodeCast($user, $codeCast)
    {
        $licences = Application::$licenceGateway->findLicenceByUserAndCodeCast($user, $codeCast);

        return $licences->filter(function ($licence) {
            return $licence->isDownloadable();
        })->size() > 0;
    }
}