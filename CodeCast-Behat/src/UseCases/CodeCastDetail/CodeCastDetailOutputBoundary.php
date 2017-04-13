<?php 

namespace CodeCast\UseCases\CodeCastDetail;

interface CodeCastDetailOutputBoundary
{
    public function present($responseModel);

    public function getResponseModel();

    public function getViewModel();
}