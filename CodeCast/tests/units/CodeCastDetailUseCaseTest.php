<?php 

use CodeCast\{Context, GateKeeper};
use CodeCast\Entities\{User, CodeCast, Licence};
use CodeCast\UseCases\CodeCastDetail\CodeCastDetailUseCase;

class CodeCastDetailUseCaseTest extends PHPUnit\Framework\TestCase
{
    use FixtureSetUp;

    public function setUp()
    {
        parent::setUp();
        static::setUpContext();
        $this->user = Context::$userGateway->save(new User('User'));
        $this->codeCast = Context::$codeCastGateway->save(new CodeCast('Episode 1', new DateTime('now')));  
        $this->useCase = new CodeCastDetailUseCase; 
        $this->presenterSpy = new CodeCastDetailOutputBoundarySpy;      
    }

    /** @test */
    public function usecase_is_wiring_with_output_boundary()
    {
        $this->useCase->requestDetailByPermalink('episode-1', $this->user, $this->presenterSpy);

        $this->assertNotNull($this->presenterSpy->getResponseModel());
    }

    /** @test */
    public function givenOneCodeCastNoLicence_detailCanBeRequestedByPermalink()
    {
        $this->codeCast->setPermalink('episode-1');

        $this->useCase->requestDetailByPermalink('episode-1', $this->user, $this->presenterSpy);
        $codeCastDetailResponseModel = $this->presenterSpy->getResponseModel();

        $this->assertEquals('episode-1', $codeCastDetailResponseModel->permalink);
        $this->assertFalse($codeCastDetailResponseModel->isViewable);
        $this->assertFalse($codeCastDetailResponseModel->isDownloadable);
    }

    /** @test */
    public function givenOneCodeCastOneViewLicence_detailCanBeRequestedByPermalink()
    {
        $this->codeCast->setPermalink('episode-1');
        Context::$licenceGateway->save(new Licence(Licence::VIEWABLE, $this->user, $this->codeCast));

        $this->useCase->requestDetailByPermalink('episode-1', $this->user, $this->presenterSpy);
        $codeCastDetailResponseModel = $this->presenterSpy->getResponseModel();

        $this->assertEquals('episode-1', $codeCastDetailResponseModel->permalink);
        $this->assertTrue($codeCastDetailResponseModel->isViewable);
        $this->assertFalse($codeCastDetailResponseModel->isDownloadable);                
    }

    /** @test */
    public function givenOneCodeCastOneDownloadLicence_detailCanBeRequestedByPermalink()
    {
        $this->codeCast->setPermalink('episode-1');
        Context::$licenceGateway->save(new Licence(Licence::DOWALOADABLE, $this->user, $this->codeCast));

        $this->useCase->requestDetailByPermalink('episode-1', $this->user, $this->presenterSpy);
        $codeCastDetailResponseModel = $this->presenterSpy->getResponseModel();

        $this->assertEquals('episode-1', $codeCastDetailResponseModel->permalink);
        $this->assertFalse($codeCastDetailResponseModel->isViewable);
        $this->assertTrue($codeCastDetailResponseModel->isDownloadable);    
    }
 

    /** @test */
    public function wont_crash_when_there_is_no_codecast()
    {
        Context::$codeCastGateway->delete($this->codeCast);

        $this->useCase->requestDetailByPermalink('non-exist-permalink', $this->user, $this->presenterSpy);
        $codeCastDetailResponseModel = $this->presenterSpy->getResponseModel();

        $this->assertEquals('not-found', $codeCastDetailResponseModel->permalink);
    }
}