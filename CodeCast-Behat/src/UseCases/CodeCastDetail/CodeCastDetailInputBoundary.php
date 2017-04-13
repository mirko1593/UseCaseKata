<?php 

namespace CodeCast\UseCases\CodeCastDetail;

interface CodeCastDetailInputBoundary
{
    public function requestDetailByPermalink($permalink, $loggedInUser, $presenter);
}