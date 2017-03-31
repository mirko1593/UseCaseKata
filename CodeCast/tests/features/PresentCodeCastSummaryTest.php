<?php 

use CodeCast\Gateway\MockGateway;
use CodeCast\{Context, GateKeeper};
use CodeCast\UseCases\CodeCastSummary\CodeCastSummariesUseCase;

class PresentCodeCastSummaryTest extends PHPUnit\Framework\TestCase
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
        $this->useCase = new CodeCastSummariesUseCase;
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

        $presentableCodeCasts = $this->useCase->presentCodeCast(Context::$gatekeeper->getLoggedInUser());

        $this->assertEquals(1, $presentableCodeCasts->size());
        $this->assertTrue($presentableCodeCasts->first()->isViewable);
    }   

    /** @test */
    public function can_view_codecast_user_has_been_licenced_to_in_order()
    {
        $this->addUser('username');
        $this->loginUser('username');   
        $codeCasts = $this->givenCodeCasts(); 

        $this->createLicenceForViewing('username', 'Episode 2');
        $this->createLicenceForDownloading('username', 'Episode 1');

        $presentableCodeCasts = $this->useCase->presentCodeCast(Context::$gatekeeper->getLoggedInUser());

        $this->assertEquals(3, $presentableCodeCasts->size());
        $this->assertArraySubset(
            $this->makeResponseData($codeCasts), 
            $presentableCodeCasts->map(function ($presentableCodeCast) {
                return $presentableCodeCast->toArray();
            })->toArray()
        );
    }
}