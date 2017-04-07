<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

class CodeCastSummariesResponseModel
{
    protected $codeCastSummaries;

    public function __construct($codeCastSummaries)
    {
        $this->codeCastSummaries = $codeCastSummaries;
    }

    public function size()
    {
        return $this->codeCastSummaries->size();
    }

    public function getCodeCastSummaries()
    {
        return $this->codeCastSummaries;
    }
}