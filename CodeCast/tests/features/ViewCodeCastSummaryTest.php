<?php 

class ViewCodeCastSummaryTest extends PHPUnit\Framework\TestCase
{
    use CodeCastPresentation;

    /** @test */
    public function can_view_no_codecast_when_no_codecast_was_given()
    {
        # Given no codecasts and With user U logged in
        $this->assertTrue($this->clearCodeCasts());

        # When user U see codecast presentation
        # Then no codecast presented.
    }   
}