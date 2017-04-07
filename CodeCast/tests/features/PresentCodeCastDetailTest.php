<?php 

use CodeCast\{Context, GateKeeper};
use CodeCast\UseCases\CodeCastDetail\CodeCastDetailUseCase;
use CodeCast\UseCases\CodeCastDetail\CodeCastDetailPresenter;

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
        $this->presenter = new CodeCastDetailPresenter;
    }


    /** @test */
    public function can_view_codecast_detail_through_permalink()
    {
        $this->addUser('username');
        $this->loginUser('username');   
        $codeCast = $this->givenCodeCast();
        $this->setPermalinkTo('episode-1', $codeCast);

        $this->useCase->requestDetailByPermalink('episode-1', Context::$gatekeeper->getLoggedInUser(), $this->presenter);
        $codeCastViewModel = $this->presenter->getViewModel();

        $this->assertArraySubset($this->makeCodeCastDetail($codeCast), $codeCastViewModel->toArray());
    }
}