<?php 

use CodeCast\Context;
use CodeCast\Gateway\MockGateway;

trait CodeCastPresentation
{
    public function setUp()
    {
        parent::setUp();
        Context::$gateway = new MockGateway;
    }

    protected function clearCodeCasts()
    {
        $codecasts = Context::$gateway->findAllCodeCasts();
        // $codecasts->each(function ($codecast) {
        //     Context::$gateway->delete($codecast);
        // });
        foreach ($codecasts as $codecast) {
            Context::$gateway->delete($codecast);
        }

        return sizeof(Context::$gateway->findAllCodeCasts()) === 0;
    }
}