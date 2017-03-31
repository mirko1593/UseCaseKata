<?php 

use CodeCast\{Context, GateKeeper};
use CodeCast\UseCases\CodeCastDetail\CodeCastDetailUseCase;

class PresentCodeCastDetailTest extends PHPUnit\Framework\TestCase
{
    use CodeCastPresentation;

    use GivenCodeCasts;

    use CodeCastDetails;

    use FixtureSetUp;

    public function setUp()
    {
        parent::setUp();
        static::setUpContext();
        $this->useCase = new CodeCastDetailUseCase;
    }


    /** @test */
    public function can_view_codecast_detail_through_permalink()
    {
        $this->addUser('username');
        $this->loginUser('username');   
        $codeCast = $this->givenCodeCast();
        $this->setPermalinkTo('episode-1', $codeCast);

        $presentableCodeCast = $this->useCase->requestDetailsByPermalink('episode-1', Context::$gatekeeper->getLoggedInUser());

        $this->assertArraySubset($this->makeCodeCastDetail($codeCast), $presentableCodeCast->toArray());
    }
}