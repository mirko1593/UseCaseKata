<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

class CodeCastSummariesPresenter implements CodeCastSummariesOutputBoundary
{
    protected $viewModel;

    protected $responseModel;

    public function getViewModel()
    {
        return $this->viewModel ?? collect();
    }

    public function getResponseModel()
    {
        return $this->responseModel;
    }

    public function present($responseModel)
    {
        $this->responseModel = $responseModel;

        $viewableCodeCastSummaries = $responseModel->getCodeCastSummaries()->map(function ($codeCastSummary) {
            return $this->presentCodeCastSummary($codeCastSummary);
        });
        $viewModel = new CodeCastSummariesViewModel;
        $viewModel->setViewableCodeCastSummaries($viewableCodeCastSummaries);
        $this->viewModel = $viewModel;
    }

    protected function presentCodeCastSummary($codeCastSummary)
    {
        $vccs = new ViewableCodeCastSummary;
        $vccs->title = $codeCastSummary->title;
        $vccs->publicationDate = $codeCastSummary->publicationDate;
        $vccs->isViewable = $codeCastSummary->isViewable;
        $vccs->isDownloadable = $codeCastSummary->isDownloadable;

        return $vccs;
    }

}