<?php 

namespace CodeCast\UseCases\CodeCastDetail;

class CodeCastDetailPresenter implements CodeCastDetailOutputBoundary
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
        $this->viewModel = $this->presentViewModelField();
    }

    protected function presentViewModelField()
    {
        $vm = new CodeCastDetailViewModel();
        $vm->title = $this->responseModel->title;
        $vm->publicationDate = $this->responseModel->publicationDate;
        $vm->description = $this->responseModel->description;
        $vm->picture = $this->responseModel->picture;
        $vm->viewable = $this->responseModel->isViewable ? '+' : '-';
        $vm->downloadable = $this->responseModel->isDownloadable ? '+' : '-';

        return $vm;
    }
}