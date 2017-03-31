<?php 

use CodeCast\Gateway\MockGateway;
use CodeCast\{Context, GateKeeper, User, CodeCast, CodeCastDetailUseCase};

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

        $presentableCodeCast = $this->useCase->requestDetailsByPermalink('episode-1', $this->user);

        $this->assertEquals('Episode 1', $presentableCodeCast->title);
        $this->assertEquals('episode-1', $presentableCodeCast->permalink);
        $this->assertEquals($this->codeCast->getPublicationDate()->format('Y-m-d'), $presentableCodeCast->publicationDate);
        $this->assertFalse($presentableCodeCast->isViewable);
        $this->assertFalse($presentableCodeCast->isDownloadable);
    }    
}