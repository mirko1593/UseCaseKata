<?php 

use CodeCast\Context;
use CodeCast\Entities\CodeCast;

trait GivenCodeCasts
{
    public function givenCodeCast()
    {
        $codeCast = new CodeCast('Episode 1', new DateTime('now'));

        return Context::$codeCastGateway->save($codeCast);
    }

    public function givenCodeCasts()
    {
        $codeCasts = collect([
            new CodeCast('Episode 3', new DateTime('2017-06-01')),
            new CodeCast('Episode 1', new DateTime('2017-04-01')),
            new CodeCast('Episode 2', new DateTime('2017-05-01')),
        ]);

        return Context::$codeCastGateway->saveManyCodeCasts($codeCasts);
    }

    public function setPermalinkTo($permalink, $codeCast)
    {
        $codeCast->setPermalink($permalink);

        return $codeCast;
    }
}