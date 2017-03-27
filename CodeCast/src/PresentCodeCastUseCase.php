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
            $pcc->isViewable = $this->isLicencedToViewCodeCast($loggedInUser, $codeCast);
            return $pcc;
        });
    }

    public function isLicencedToViewCodeCast($user, $codeCast)
    {
        return Context::$gateway->findLicenceForUserAndCodeCast($user, $codeCast)->size() !== 0;
    }
}