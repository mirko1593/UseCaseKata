<?php 

namespace CodeCast\Gateway;

interface LicenceGateway
{
    public function save($licence);

    public function findLicenceForUserAndCodeCast($user, $codeCast);    
}