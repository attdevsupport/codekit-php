<?php
require_once __DIR__ . '/../lib/OAuth/OAuthTokenService.php'; 

use Att\Api\OAuth\OAuthTokenService;

class OAuthTokenServiceTest extends PHPUnit_Framework_TestCase 
{
    public function testRequest() 
    {
        require __DIR__ . '/cfgs/ads_config.php';

        if (isset($proxyHost) && isset($proxyPort))
            RestfulEnvironment::setProxy($proxyHost, $proxyPort);
        if (isset($allowAllCerts))
            RestfulEnvironment::setAcceptAllCerts($allowAllCerts);

        $tokenSrvc = new OAuthTokenService($FQDN, $api_key, $secret_key);
        $token = $tokenSrvc->getToken('ADS');

        $this->assertTrue($token->getAccessToken() != '');

        $token = $tokenSrvc->refreshToken($token);
        $this->assertTrue($token->getAccessToken() != '');
    }

}

?>
