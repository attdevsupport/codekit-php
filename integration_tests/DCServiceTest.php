<?php

require_once __DIR__ . '/../lib/DC/DCService.php'; 
require_once __DIR__ . '/../lib/OAuth/OAuthToken.php'; 

use Att\Api\OAuth\OAuthToken;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Restful\RestfulEnvironment;
use Att\Api\DC\DCService;

class DCServiceTest extends PHPUnit_Framework_TestCase 
{
    public function testRequest() 
    {
        require __DIR__ . '/cfgs/dc_config.php';

        if (isset($proxyHost) && isset($proxyPort))
            RestfulEnvironment::setProxy($proxyHost, $proxyPort);
        if (isset($allowAllCerts))
            RestfulEnvironment::setAcceptAllCerts($allowAllCerts);

        $token = new OAuthToken($accessToken, OAuthToken::NO_EXPIRATION, '');
        $dcService = new DCService($FQDN, $token);
        $response = $dcService->getDeviceInformation();
        $this->assertTrue($response->getCapabilities() != null);
    }

}

?>
