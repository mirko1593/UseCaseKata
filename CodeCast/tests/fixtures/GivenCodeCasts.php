<?php 

use CodeCast\{Context, CodeCast};

trait GivenCodeCasts
{
    public function givenCodeCast()
    {
        $codeCast = new CodeCast('Episode 1', date('Y-m-d'));

        Context::$gateway->save($codeCast);
    }

    public function givenCodeCasts()
    {
        $codeCasts = collect([
            new CodeCast('Episode 1', date('Y-m-d')),
            new CodeCast('Episode 2', date('Y-m-d')),
            new CodeCast('Episode 3', date('Y-m-d'))
        ]);

        return Context::$gateway->saveManyCodeCasts($codeCasts);
    }
}