<?php 

use CodeCast\{Context, CodeCast};

trait GivenCodeCasts
{
    public function givenCodeCast()
    {
        $codeCast = new CodeCast('Episode 1', date('Y-m-d'));

        Context::$gateway->save($codeCast);
    }
}