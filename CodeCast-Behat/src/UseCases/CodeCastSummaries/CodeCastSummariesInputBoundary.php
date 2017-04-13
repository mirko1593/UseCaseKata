<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

interface CodeCastSummariesInputBoundary
{
    public function summarizeCodeCasts($loggedInUser, $presenter);
}