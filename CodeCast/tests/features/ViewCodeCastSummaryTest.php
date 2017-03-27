<?php 

use CodeCast\Gateway\MockGateway;
use CodeCast\{Context, GateKeeper, PresentCodeCastUseCase};

class ViewCodeCastSummaryTest extends PHPUnit\Framework\TestCase
{
    use CodeCastPresentation;

    use GivenCodeCasts;

    protected $useCase;

    public function setUp()
    {
        parent::setUp();
        Context::$gateway = new MockGateway;
        Context::$gatekeeper = new GateKeeper;
        $this->useCase = new PresentCodeCastUseCase;
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

    /** @test */
    public function can_view_codecast_user_has_been_licenced_to()
    {
        $this->addUser('username');
        $this->loginUser('username');   
        $this->givenCodeCast();
        $this->createLicenceForViewing('username', 'Episode 1');

        $codeCasts = $this->useCase->presentCodeCast(Context::$gatekeeper->getLoggedInUser());

        $this->assertEquals(1, $codeCasts->size());
        $this->assertTrue($codeCasts->first()->isViewable);
    }   
}