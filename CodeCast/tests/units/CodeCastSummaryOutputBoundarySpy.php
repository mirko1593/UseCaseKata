<?php 

use CodeCast\UseCases\CodeCastSummaries\CodeCastSummariesViewModel;
use CodeCast\UseCases\CodeCastSummaries\CodeCastSummaryOutputBoundary;

class CodeCastSummaryOutputBoundarySpy implements CodeCastSummaryOutputBoundary
{
    protected $responseModel;

    protected $viewModel;

    public function getResponseModel()
    {
        return $this->responseModel;   
    }

    public function present($responseModel)
    {
        $this->responseModel = $responseModel;
        $this->viewModel = new CodeCastSummariesViewModel();
        $this->viewModel->setViewableCodeCastSummary($this->responseModel->getCodeCastSummaryCollection());
    }

    public function getViewModel()
    {
        return $this->viewModel;
    }
}