<?php 

use CodeCast\UseCases\CodeCastDetail\CodeCastDetailOutputBoundary;

class CodeCastDetailOutputBoundarySpy implements CodeCastDetailOutputBoundary
{
    protected $viewModel;

    protected $responseModel;

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