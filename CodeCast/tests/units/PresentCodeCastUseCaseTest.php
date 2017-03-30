<?php 

use CodeCast\Gateway\MockGateway;
use CodeCast\{
    User, CodeCast, Licence, Context, GateKeeper, PresentCodeCastUseCase
};

class PresentCodeCastUseCaseTest extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        parent::setUp();
        Context::$gateway = new MockGateway;
        Context::$gatekeeper = new GateKeeper;
        $this->user = Context::$gateway->saveUser(new User('User'));
        $this->codeCast = Context::$gateway->save(new CodeCast('Episode 1', date('Y-m-d'))); 
        $this->useCase = new PresentCodeCastUseCase;
    }     

    /** @test */
    public function user_without_a_licence_cannot_view_codecast()
    {
        $codeCast = new CodeCast('Episode 2', date('Y-m-d'));
        $user = Context::$gateway->save(new User('U'));

        $this->assertFalse($this->useCase->isLicencedToViewCodeCast($user, $codeCast));
    }    

    /** @test */
    public function user_with_a_view_licence_can_view_codecast()
    {
        Context::$gateway->saveLicence(new Licence(Licence::VIEWABLE, $this->user, $this->codeCast));

        $this->assertTrue($this->useCase->isLicencedToViewCodeCast($this->user, $this->codeCast));
    }

    /** @test */
    public function user_without_a_view_licence_cannot_view_others_codecast()
    {
        $otherUser = Context::$gateway->saveUser(new User('OtherUser'));

        $this->assertFalse($this->useCase->isLicencedToViewCodeCast($otherUser, $this->codeCast));
    }

    /** @test */
    public function present_no_codecast()
    {
        Context::$gateway->delete($this->codeCast);
        $codeCasts = $this->useCase->presentCodeCast($this->user);

        $this->assertEquals(0, $codeCasts->size());
    }

    /** @test */
    public function can_view_presentable_codecast_if_a_view_licence_exists()
    {
        $licence = Context::$gateway->saveLicence(new Licence(Licence::VIEWABLE, $this->user, $this->codeCast));

        $codeCasts = $this->useCase->presentCodeCast($this->user);

        $this->assertTrue($codeCasts->first()->isViewable);
    }

    /** @test */
    public function cannot_view_a_codecast_if_a_licence_not_exists()
    {
        $codeCasts = $this->useCase->presentCodeCast($this->user);
        
        $this->assertFalse($codeCasts->first()->isViewable);        
    }

    /** @test */
    public function can_download_a_presentable_codecast_if_a_download_licence_exists()
    {
        $licence = Context::$gateway->saveLicence(new Licence(Licence::DOWALOADABLE, $this->user, $this->codeCast));

        $codeCasts = $this->useCase->presentCodeCast($this->user);

        $this->assertTrue($codeCasts->first()->isDownloadable);
    }
}