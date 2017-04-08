<?php 

use CodeCast\User;
use CodeCast\Licence;
use CodeCast\CodeCast;
use CodeCast\Application;
use CodeCast\UseCases\CodeCastSummaries\CodeCastSummariesUseCase;

class CodeCastSummariesUseCaseTest extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        parent::setUp();
        FeatureSetUp::setUp();
        $this->user = Application::$userGateway->save(new User('User'));
        $this->useCase = new CodeCastSummariesUseCase;
        $this->presenterSpy = new CodeCastSummariesPresenterSpy;
    }

    /** @test */
    public function usecase_is_wiring_with_output_boundary()
    {
        $this->useCase->summarizeCodeCasts($this->user, $this->presenterSpy);

        $this->assertNotNull($this->presenterSpy->getResponseModel());
    }    

    /** @test */
    public function givenNoCodeCast_usecaseSummarizeNoCodeCasts()
    {
        $this->useCase->summarizeCodeCasts($this->user, $this->presenterSpy);

        $this->assertSame(0, $this->presenterSpy->getResponseModel()->size());
    }

    /** @test */
    public function givenOneCodeCastNoLicence_useCaseCanSummarizeOneSummary()
    {
        Application::$codeCastGateway->save(new CodeCast('Episode', new DateTime('2017-05-01')));

        $this->useCase->summarizeCodeCasts($this->user, $this->presenterSpy);

        $this->assertSame(1, $this->presenterSpy->getResponseModel()->size());
    }

    /** @test */
    public function givenOneCodeCastOneViewLicence_useCaseSummarizeOneViewableSummary()
    {
        $codeCast = Application::$codeCastGateway->save(new CodeCast('Episode', new DateTime('2017-05-01')));
        Application::$licenceGateway->save(new Licence(Licence::VIEWABLE, $this->user, $codeCast));

        $this->assertTrue($this->useCase->isLicencedToViewCodeCast($this->user, $codeCast));
    }
}