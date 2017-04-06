<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

interface CodeCastSummaryOutputBoundary
{
    public function getResponseModel();

    public function present($responseModel);

    public function getViewModel();
}