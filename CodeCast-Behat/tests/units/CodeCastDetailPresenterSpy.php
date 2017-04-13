<?php 

use CodeCast\UseCases\CodeCastDetail\CodeCastDetailOutputBoundary;

class CodeCastDetailPresenterSpy implements CodeCastDetailOutputBoundary
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