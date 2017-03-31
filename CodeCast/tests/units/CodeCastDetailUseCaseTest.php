<?php 

use CodeCast\Gateway\MockGateway;
use CodeCast\{Context, GateKeeper};
use CodeCast\Entities\{User, CodeCast};
use CodeCast\UseCases\CodeCastDetail\CodeCastDetailUseCase;

class CodeCastDetailUseCaseTest extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        parent::setUp();
        Context::$gateway = new MockGateway;
        Context::$gatekeeper = new GateKeeper;
        $this->user = Context::$gateway->saveUser(new User('User'));
        $this->codeCast = Context::$gateway->save(new CodeCast('Episode 1', new DateTime('now')));  
        $this->useCase = new CodeCastDetailUseCase;       
    }

    /** @test */
    public function can_request_codecast_detail_by_permalink()
    {
        $this->codeCast->setPermalink('episode-1');

        $presentableCodeCastDetail = $this->useCase->requestDetailsByPermalink('episode-1', $this->user);

        $this->assertEquals('Episode 1', $presentableCodeCastDetail->title);
        $this->assertEquals('episode-1', $presentableCodeCastDetail->permalink);
        $this->assertEquals($this->codeCast->getPublicationDate()->format('Y-m-d'), $presentableCodeCastDetail->publicationDate);
        $this->assertFalse($presentableCodeCastDetail->isViewable);
        $this->assertFalse($presentableCodeCastDetail->isDownloadable);
    }    

    /** @test */
    public function wont_crash_when_there_is_no_codecast()
    {
        Context::$gateway->delete($this->codeCast);

        $presentableCodeCastDetail = $this->useCase->requestDetailsByPermalink('non-exist-permalink', $this->user);

        $this->assertEquals('not-found', $presentableCodeCastDetail->permalink);
    }
}