<?php 

use CodeCast\{Context, PresentCodeCastUseCase};
use CodeCast\Entities\{User, Licence};

trait CodeCastPresentation
{
    protected function clearCodeCasts()
    {
        $codeCasts = Context::$codeCastGateway->findAllCodeCasts();
        $codeCasts->each(function ($codeCast) {
            Context::$codeCastGateway->delete($codeCast);
        });

        return Context::$codeCastGateway->findAllCodeCasts()->size() === 0;
    }

    protected function addUser($username)
    {
        Context::$userGateway->save(new User($username));
    }

    protected function loginUser($username)
    {
        $user = Context::$userGateway->findUser($username);
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
        $user = Context::$userGateway->findUser($username);
        $codeCast = Context::$codeCastGateway->findCodeCastByTitle($codeCastTitle);
        Context::$licenceGateway->save(new Licence(Licence::VIEWABLE, $user, $codeCast));

        return $this->useCase->isLicencedToViewCodeCast($user, $codeCast);
    }

    protected function createLicenceForDownloading($username, $codeCastTitle)
    {
        $user = Context::$userGateway->findUser($username);
        $codeCast = Context::$codeCastGateway->findCodeCastByTitle($codeCastTitle);
        Context::$licenceGateway->save(new Licence(Licence::DOWALOADABLE, $user, $codeCast));

        return $this->useCase->isLicencedToViewCodeCast($user, $codeCast);
    }
}