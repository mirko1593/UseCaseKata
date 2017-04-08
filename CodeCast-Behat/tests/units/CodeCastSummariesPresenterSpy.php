<?php 

use CodeCast\UseCases\CodeCastSummaries\CodeCastSummariesOutputBoundary;

class CodeCastSummariesPresenterSpy implements CodeCastSummariesOutputBoundary
{
    protected $responseModel;

    protected $viewModel;

    public function getResponseModel()
    {
        return $this->responseModel;
    }

    public function getViewModel()
    {
        return $this->viewModel;
    }

    public function present($responseModel)
    {
        $this->responseModel = $responseModel;
    }
}