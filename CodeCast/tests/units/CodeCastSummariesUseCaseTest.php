<?php 

use CodeCast\{Context, GateKeeper};
use CodeCast\Entities\{User, CodeCast, Licence};
use CodeCast\UseCases\CodeCastSummaries\CodeCastSummariesUseCase;

class CodeCastSummariesUseCaseTest extends PHPUnit\Framework\TestCase
{
    use FixtureSetUp;

    public function setUp()
    {
        parent::setUp();
        static::setUpContext();       
        $this->user = Context::$userGateway->save(new User('User'));
        $this->presenterSpy = new CodeCastSummariesOutputBoundarySpy();
        $this->useCase = new CodeCastSummariesUseCase;
    }     

    /** @test */
    public function usecase_is_wiring_with_a_output_boundary()
    {
        $this->useCase->summarizeCodecasts($this->user, $this->presenterSpy);
        $this->assertNotNull($this->presenterSpy->getResponseModel());
    }

    /** @test */
    public function givenNoCodecasts_usecaseSummarizeNoCodecasts()
    {
        $this->useCase->summarizeCodecasts($this->user, $this->presenterSpy);
        $this->assertSame(0, $this->presenterSpy->getResponseModel()->size());
    }

    /** @test */
    public function giveOneCodeCast_usecaseSummarizeOneCodeCast()
    {
        Context::$codeCastGateway->save(new CodeCast('Episode', new DateTime('now')));

        $this->useCase->summarizeCodecasts($this->user, $this->presenterSpy);

        $this->assertSame(1, $this->presenterSpy->getResponseModel()->size());        
    }

    /** @test */
    public function giveOneCodeCastAndNoLicence_userCanNotViewCodeCast()
    {
        $codeCast = Context::$codeCastGateway->save(new CodeCast('Episode', new DateTime('now')));

        $this->assertFalse($this->useCase->isLicencedToViewCodeCast($this->user, $codeCast));
    }

    /** @test */
    public function giveOneCodeCastAndOneViewLicence_userCanViewCodeCast()
    {
        $codeCast = Context::$codeCastGateway->save(new CodeCast('Episode', new DateTime('now')));
        Context::$licenceGateway->save(new Licence(Licence::VIEWABLE, $this->user, $codeCast));

        $this->assertTrue($this->useCase->isLicencedToViewCodeCast($this->user, $codeCast));        
    }

    /** @test */
    public function givenAUserHaveNotBeenLicenced_userCannotViewOthersCodeCast()
    {
        $codeCast = Context::$codeCastGateway->save(new CodeCast('Episode', new DateTime('now')));
        $user = Context::$userGateway->save(new User('User'));
        Context::$licenceGateway->save(new Licence(Licence::VIEWABLE, $user, $codeCast));

        $this->assertFalse($this->useCase->isLicencedToViewCodeCast($this->user, $codeCast));
    }

    /** @test */
    public function givenOneCodeCastAndNoDownloadLicence_userCanNotDownloadCodeCast()
    {
        $codeCast = Context::$codeCastGateway->save(new CodeCast('Episode', new DateTime('now')));

        $this->assertFalse($this->useCase->isLicencedToDownloadCodeCast($this->user, $codeCast));
    }

    /** @test */
    public function givenOneCodeCastAndOneDownloadLicence_userCanDownloadCodeCast()
    {
        $codeCast = Context::$codeCastGateway->save(new CodeCast('Episode', new DateTime('now')));
        Context::$licenceGateway->save(new Licence(Licence::DOWALOADABLE, $this->user, $codeCast));

        $this->assertTrue($this->useCase->isLicencedToDownloadCodeCast($this->user, $codeCast));
    }

    /** @test */
    public function givenAUserHaveNotBeenLicenced_userCannotDownloadOthersCodeCast()
    {
        $codeCast = Context::$codeCastGateway->save(new CodeCast('Episode', new DateTime('now')));
        $user = Context::$userGateway->save(new User('User'));
        Context::$licenceGateway->save(new Licence(Licence::DOWALOADABLE, $user, $codeCast));

        $this->assertFalse($this->useCase->isLicencedToDownloadCodeCast($this->user, $codeCast));
    }    
}