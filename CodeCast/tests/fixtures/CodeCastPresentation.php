<?php 

use CodeCast\{
    Context, User, Licence, PresentCodeCastUseCase
};

trait CodeCastPresentation
{
    protected function clearCodeCasts()
    {
        $codeCasts = Context::$gateway->findAllCodeCasts();
        $codeCasts->each(function ($codeCast) {
            Context::$gateway->delete($codeCast);
        });

        return Context::$gateway->findAllCodeCasts()->size() === 0;
    }

    protected function addUser($username)
    {
        Context::$gateway->saveUser(new User($username));
    }

    protected function loginUser($username)
    {
        $user = Context::$gateway->findUser($username);
        if (! is_null($user)) {
            Context::$gatekeeper->setLoggedInUser($user);
            return true;
        } else {
            return false;
        }
    }

    protected function countOfPresentedCodeCasts()
    {
        return $this->useCase->presentCodeCast(Context::$gatekeeper->getLoggedInUser())->size();
    }

    protected function createLicenceForViewing($username, $codeCastTitle)
    {
        $user = Context::$gateway->findUser($username);
        $codeCast = Context::$gateway->findCodeCastByTitle($codeCastTitle);
        Context::$gateway->saveLicence(new Licence($user, $codeCast));

        return $this->useCase->isLicencedToViewCodeCast($user, $codeCast);
    }

    protected function createLicenceForDownloading($username, $codeCast)
    {
        
    }
}