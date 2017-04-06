<?php 

use CodeCast\{Context, GateKeeper};
use CodeCast\UseCases\CodeCastSummaries\CodeCastSummariesUseCase;

class PresentCodeCastSummariesTest extends PHPUnit\Framework\TestCase
{
    use CodeCastPresentation;

    use GivenCodeCasts;

    use OfCodeCasts;

    use FixtureSetUp;

    protected $useCase;

    public function setUp()
    {
        parent::setUp();
        static::setUpContext();
        $this->useCase = new CodeCastSummariesUseCase;
        $this->presenterSpy = new CodeCastSummaryOutputBoundarySpy();
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

        $this->useCase->summarizeCodecasts(Context::$gatekeeper->getLoggedInUser(), $this->presenterSpy);
        $codeCastSummariesViewModel = $this->presenterSpy->getViewModel();

        $this->assertEquals(1, $codeCastSummariesViewModel->size());
        $this->assertTrue($codeCastSummariesViewModel->first()->isViewable);
    }   

    // /** @test */
    public function can_view_codecast_user_has_been_licenced_to_in_order()
    {
        // TODO: Make this pass, and refactor ViewModel.
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