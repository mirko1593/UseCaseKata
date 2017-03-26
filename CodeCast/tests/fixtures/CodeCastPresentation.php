<?php 

use CodeCast\{Context, User};

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

    public function addUser($username)
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
}