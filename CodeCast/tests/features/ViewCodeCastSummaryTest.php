<?php 

use CodeCast\Gateway\MockGateway;
use CodeCast\{Context, GateKeeper, PresentCodeCastUseCase};

class ViewCodeCastSummaryTest extends PHPUnit\Framework\TestCase
{
    use CodeCastPresentation;

    use GivenCodeCasts;

    use OfCodeCasts;

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

        $presentCodeCasts = $this->useCase->presentCodeCast(Context::$gatekeeper->getLoggedInUser());

        $this->assertEquals(1, $presentCodeCasts->size());
        $this->assertTrue($presentCodeCasts->first()->isViewable);
    }   

    /** @test */
    public function can_view_codecast_user_has_been_licenced_to_in_order()
    {
        $this->addUser('username');
        $this->loginUser('username');   
        $codeCasts = $this->givenCodeCasts(); 
        $this->createLicenceForViewing('username', 'Episode 2');

        $presentCodeCasts = $this->useCase->presentCodeCast(Context::$gatekeeper->getLoggedInUser());

        $this->assertEquals(3, $presentCodeCasts->size());

        $this->assertArraySubset($this->makeResponseData($codeCasts), $presentCodeCasts->map(function ($presentCodeCast) {
            return $presentCodeCast->toArray();
        })->toArray());
    }
}