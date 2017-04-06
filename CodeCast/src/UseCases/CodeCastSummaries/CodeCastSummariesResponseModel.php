<?php 

namespace CodeCast\UseCases\CodeCastSummaries;

class CodeCastSummariesResponseModel
{
    protected $codeCastSummaryCollection;

    public function __construct($codeCastSummaryCollection)
    {
        $this->codeCastSummaryCollection = $codeCastSummaryCollection;
    }

    public function size()
    {
        return $this->codeCastSummaryCollection->size();
    }

    public function getCodeCastSummaryCollection()
    {
        return $this->codeCastSummaryCollection;
    }
}