<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

interface CodeCastSummariesOutputBoundary
{
    public function getResponseModel();

    public function getViewModel();

    public function present($responseModel);
}