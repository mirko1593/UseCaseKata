<?php 

use CodeCast\CodeCast;

class CodeCastTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    public function codeCasts_with_different_title_is_not_the_same_codeCast()
    {
        $codeCast1 = new CodeCast('Episode 1', date('Y-m-d'));
        $codeCast2 = new CodeCast('Episode 2', date('Y-m-d'));

        $this->assertFalse($codeCast1->isSame($codeCast2));
    }

    /** @test */
    public function codeCasts_can_be_retrieved_in_order()
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