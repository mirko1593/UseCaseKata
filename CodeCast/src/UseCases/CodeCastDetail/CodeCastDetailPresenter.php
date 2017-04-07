<?php 

namespace CodeCast\UseCases\CodeCastDetail;

class CodeCastDetailPresenter implements CodeCastDetailOutputBoundary
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
        $this->viewModel = new CodeCastDetailViewModel();
        $this->viewModel->title = $responseModel->title;
        $this->viewModel->publicationDate = $responseModel->publicationDate;
        $this->viewModel->permalink = $responseModel->permalink;
        $this->viewModel->isViewable = $responseModel->isViewable;
        $this->viewModel->isDownloadable = $responseModel->isDownloadable;
    }
}