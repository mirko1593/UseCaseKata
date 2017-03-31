<?php 

use CodeCast\{Context, GateKeeper};
use CodeCast\Entities\{User, CodeCast};

trait FixtureSetUp
{
    public static function setUpContext()
    {
        Context::$gatekeeper = new GateKeeper;
        Context::$codeCastGateway = new InMemoryCodeCastGateway;
        Context::$userGateway = new InMemoryUserGateway;
        Context::$licenceGateway = new InMemoryLicenceGateway;        
    }
}