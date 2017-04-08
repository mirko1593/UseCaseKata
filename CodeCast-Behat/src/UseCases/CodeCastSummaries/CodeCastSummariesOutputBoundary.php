<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

interface CodeCastSummariesOutputBoundary
{
    public function getViewModel();

    public function getResponseModel();

    public function present($responseModel);
}