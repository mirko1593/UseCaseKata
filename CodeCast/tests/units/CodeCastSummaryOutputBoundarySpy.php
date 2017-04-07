<?php 

use CodeCast\UseCases\CodeCastSummaries\CodeCastSummariesOutputBoundary;

class CodeCastSummariesOutputBoundarySpy implements CodeCastSummariesOutputBoundary
{
    protected $responseModel;

    protected $viewModel;

    protected $presentWasCalled = false;

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
        $this->presentWasCalled = true;
    }
}