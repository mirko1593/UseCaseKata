<?php 

use CodeCast\Context;
use CodeCast\Entities\CodeCast;

class CodeCastTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    public function codeCasts_can_be_retrieved_order_by_publication_date()
    {
        $codeCasts = collect([
            new CodeCast('Episode 1', new DateTime('2017-05-01')),
            new CodeCast('Episode 2', new DateTime('2017-04-01'))
        ]);

        $codeCasts = $codeCasts->sort(function ($c1, $c2) {
            return $c1->getPublicationDate() <=> $c2->getPublicationDate();
        });

        $this->assertEquals(['Episode 2', 'Episode 1'], $codeCasts->map(function ($c) {
            return $c->getTitle();
        })->toArray());
    }  
}