<?php 

use CodeCast\{Context, CodeCast};

trait GivenCodeCasts
{
    public function givenCodeCast()
    {
        $codeCast = new CodeCast('Episode 1', new DateTime('now'));

        Context::$gateway->save($codeCast);
    }

    public function givenCodeCasts()
    {
        $codeCasts = collect([
            new CodeCast('Episode 3', new DateTime('2017-06-01')),
            new CodeCast('Episode 1', new DateTime('2017-04-01')),
            new CodeCast('Episode 2', new DateTime('2017-05-01')),
        ]);

        return Context::$gateway->saveManyCodeCasts($codeCasts);
    }
}