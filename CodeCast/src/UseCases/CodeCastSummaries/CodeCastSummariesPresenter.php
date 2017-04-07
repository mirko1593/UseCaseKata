<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

class CodeCastSummariesPresenter implements CodeCastSummariesOutputBoundary
{
    protected $viewModel;

    protected $responseModel;

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
        $this->viewModel = new CodeCastSummariesViewModel();
        $codeCastSummaries = $this->responseModel->getCodeCastSummaries();
        $viewableCodeCastSummaries = $codeCastSummaries->map(function ($codeCastSummary) {
            $viewableCodeCastSummary = new ViewableCodeCastSummary();
            $viewableCodeCastSummary->title = $codeCastSummary->title;
            $viewableCodeCastSummary->publicationDate = $codeCastSummary->publicationDate;
            $viewableCodeCastSummary->isViewable = $codeCastSummary->isViewable;
            $viewableCodeCastSummary->isDownloadable = $codeCastSummary->isDownloadable;
            
            return $viewableCodeCastSummary;
        });

        $this->viewModel->setViewableCodeCastSummaries($viewableCodeCastSummaries);
    }
}