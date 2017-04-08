<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

class CodeCastSummariesPresenter implements CodeCastSummariesOutputBoundary
{
    protected $viewModel;

    public function getViewModel()
    {
        return $this->viewModel ?? collect();
    }
}