<?php 

use CodeCast\{Application, GateKeeper};

class FeatureSetUp
{
    public static function setUp($codeCastGateway = null, $userGateway = null, $licenceGateway = null, $gateKeeper = null)
    {
        Application::$codeCastGateway = $codeCastGateway ?? new InMemoryCodeCastGateway;
        Application::$userGateway = $userGateway ?? new InMemoryUserGateway;
        Application::$licenceGateway = $licenceGateway ?? new InMemoryLicenceGateway;
        Application::$gateKeeper = $gateKeeper ?? new GateKeeper;
    }
}