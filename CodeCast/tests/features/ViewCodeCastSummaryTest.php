<?php 

use CodeCast\Gateway\MockGateway;
use CodeCast\{Context, GateKeeper};

class ViewCodeCastSummaryTest extends PHPUnit\Framework\TestCase
{
    use CodeCastPresentation;

    use GivenCodeCasts;

    public function setUp()
    {
        parent::setUp();
        Context::$gateway = new MockGateway;
        Context::$gatekeeper = new GateKeeper;
    }    

    /** @test */
    public function can_view_no_codecast_when_no_codecast_was_given()
    {
        $this->clearCodeCasts();
        $this->addUser('username');
        $this->loginUser('username');

        $count = $this->countOfPresentedCodeCasts();

        $this->assertSame(0, $count);
    }   
}