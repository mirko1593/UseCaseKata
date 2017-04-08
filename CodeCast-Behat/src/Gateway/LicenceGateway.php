<?php 

namespace CodeCast\Gateway;

interface LicenceGateway
{
    public function save($licence);

    public function findLicenceByUserAndCodeCast($user, $codeCast);
}