<?php 

use CodeCast\{Context, User, PresentCodeCastUseCase};

trait CodeCastPresentation
{
    protected function clearCodeCasts()
    {
        $codecasts = Context::$gateway->findAllCodeCasts();
        $codecasts->each(function ($codecast) {
            Context::$gateway->delete($codecast);
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
        $useCase = new PresentCodeCastUseCase;

        return $useCase->presentCodeCast(Context::$gatekeeper->getLoggedInUser())->size();
    }
}