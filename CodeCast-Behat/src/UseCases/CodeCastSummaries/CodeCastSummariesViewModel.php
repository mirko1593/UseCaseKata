<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

class CodeCastSummariesViewModel
{
    protected $viewableCodeCastSummaries;

    public function __construct($viewableCodeCastSummaries = null)
    {
        $this->viewableCodeCastSummaries = $viewableCodeCastSummaries ?? collect();
    }

    public function setViewableCodeCastSummaries($viewableCodeCastSummaries)
    {
        $this->viewableCodeCastSummaries = $viewableCodeCastSummaries;
    }

    public function toArray()
    {
        return $this->viewableCodeCastSummaries->map(function ($viewableCodeCastSummary) {
            return $this->formatViewableFields($viewableCodeCastSummary);
        })->toArray();
    }

    protected function formatViewableFields($viewableCodeCastSummary)
    {
        return [
            'title' => $viewableCodeCastSummary->title,
            'publicationDate' => $viewableCodeCastSummary->publicationDate,
            'viewable' => $viewableCodeCastSummary->isViewable ? '+' : '-',
            'downloadable' => $viewableCodeCastSummary->isDownloadable ? '+' : '-'
        ];
    }

}