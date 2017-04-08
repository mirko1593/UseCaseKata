<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

class CodeCastSummariesResponseModel
{
    protected $codeCastSummaries;

    public function __construct($codeCastSummaries = null)
    {
        $this->codeCastSummaries = $codeCastSummaries ?? collect();
    }

    public function setCodeCastSummaries($codeCastSummaries)
    {
        $this->codeCastSummaries = $codeCastSummaries;
    }

    public function getCodeCastSummaries()
    {
        return $this->codeCastSummaries;
    }

    public function __call($name, $arguments)
    {
        return call_user_func([$this->codeCastSummaries, $name], $arguments);
    }
}