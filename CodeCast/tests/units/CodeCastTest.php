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
}