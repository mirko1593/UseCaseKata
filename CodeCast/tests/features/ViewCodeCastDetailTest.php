<?php 

use CodeCast\Gateway\MockGateway;
use CodeCast\{Context, GateKeeper, ViewCodeCastDetailUseCase};

class ViewCodeCastDetailTest extends PHPUnit\Framework\TestCase
{
    use CodeCastPresentation;

    use GivenCodeCasts;

    use CodeCastDetails;

    public function setUp()
    {
        parent::setUp();
        Context::$gateway = new MockGateway;
        Context::$gatekeeper = new GateKeeper;
        $this->useCase = new ViewCodeCastDetailUseCase;
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