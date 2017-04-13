<?php 

use CodeCast\User;
use CodeCast\CodeCast;
use CodeCast\Application;
use CodeCast\UseCases\CodeCastDetail\CodeCastDetailUseCase;

class CodeCastDetailUseCaseTest extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        parent::setUp();
        FeatureSetUp::setUp();
        $this->user = Application::$userGateway->save(new User('User'));
        $this->useCase = new CodeCastDetailUseCase;
        $this->presenter = new CodeCastDetailPresenterSpy;
    }

    /** @test */
    public function usecase_is_wiring_with_output_boundary()
    {
        $this->useCase->requestDetailByPermalink('episode-1', $this->user, $this->presenter);

        $this->assertNotNull($this->presenter->getResponseModel());
    }  

    /** @test */
    public function can_request_codeCast_detail_by_permalink()
    {
        $codeCast = Application::$codeCastGateway->save(new CodeCast('Episode 1', new DateTime('2017-05-01')));
        $codeCast->setPermalink('episode-1');

        $this->useCase->requestDetailByPermalink('episode-1', $this->user, $this->presenter);
        $responseModel = $this->presenter->getResponseModel();

        $this->assertArraySubset([
            'title' => $codeCast->getTitle(), 
            'publicationDate' => $codeCast->getFormattedDate(), 
            'description' => $codeCast->getDescription(), 
            'picture' => $codeCast->getPicture(), 
            'isViewable' => false, 
            'isDownloadable' => false
        ], $responseModel->toArray()); 
    }  
}