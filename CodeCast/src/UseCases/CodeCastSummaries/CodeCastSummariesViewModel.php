<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

class CodeCastSummariesViewModel
{
    protected $viewableCodeCastSummaryCollection;

    public function setViewableCodeCastSummary($viewableCodeCastSummaryCollection)
    {
        $this->viewableCodeCastSummaryCollection = $viewableCodeCastSummaryCollection;
    }

    public function size()
    {
        return $this->viewableCodeCastSummaryCollection->size();
    }

    public function first()
    {
        return $this->viewableCodeCastSummaryCollection->first();
    }
}