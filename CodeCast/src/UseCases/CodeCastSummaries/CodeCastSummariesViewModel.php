<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

class CodeCastSummariesViewModel
{
    protected $viewableCodeCastSummaries;

    public function setViewableCodeCastSummaries($viewableCodeCastSummaries)
    {
        $this->viewableCodeCastSummaries = $viewableCodeCastSummaries;
    }

    public function toArray()
    {
        return $this->viewableCodeCastSummaries->map(function ($viewableCodeCastSummary) {
            return $viewableCodeCastSummary->toArray();
        })->toArray();
    }

    public function __call($name, $arguments)
    {
        return call_user_func([$this->viewableCodeCastSummaries, $name], $arguments);
    }
}