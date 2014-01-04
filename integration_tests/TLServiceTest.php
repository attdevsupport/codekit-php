<?php

require_once __DIR__ . '/../lib/TL/TLService.php'; 

use Att\Api\OAuth\OAuthToken;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Restful\RestfulEnvironment;
use Att\Api\TL\TLService;

class TLServiceTest extends PHPUnit_Framework_TestCase 
{
    public function testRequest() 
    {
        require __DIR__ . '/cfgs/tl_config.php';

        if (isset($proxyHost) && isset($proxyPort))
            RestfulEnvironment::setProxy($proxyHost, $proxyPort);
        if (isset($allowAllCerts))
            RestfulEnvironment::setAcceptAllCerts($allowAllCerts);

        $token = new OAuthToken($accessToken, OAuthToken::NO_EXPIRATION, 'n');

        $tlService = new TLService($FQDN, $token);
        $response = $tlService->getLocation(1000, 10000, 'DelayTolerant');
        $this->assertTrue($response->getLatitude() != null);
    }

}

?>
