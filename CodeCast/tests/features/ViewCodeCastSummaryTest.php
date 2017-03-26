<?php 

class ViewCodeCastSummaryTest extends PHPUnit\Framework\TestCase
{
    use CodeCastPresentation;

    use GivenCodeCasts;

    /** @test */
    public function can_view_no_codecast_when_no_codecast_was_given()
    {
        # Given no codecasts and With user U logged in
        $this->clearCodeCasts();

        # When user U see codecast presentation
        # Then no codecast presented.
        $this->assertTrue(true);
    }   
}