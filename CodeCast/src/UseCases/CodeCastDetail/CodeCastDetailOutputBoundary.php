<?php 

namespace CodeCast\UseCases\CodeCastDetail;

interface CodeCastDetailOutputBoundary
{
    public function getViewModel();

    public function getResponseModel();

    public function present($responseModel);
}