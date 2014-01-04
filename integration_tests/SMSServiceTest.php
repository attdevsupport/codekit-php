<?php

require_once __DIR__ . '/../lib/SMS/SMSService.php'; 
require_once __DIR__ . '/../lib/OAuth/OAuthTokenService.php'; 

use Att\Api\OAuth\OAuthToken;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Restful\RestfulEnvironment;
use Att\Api\SMS\SMSService;

class SMSServiceTest extends PHPUnit_Framework_TestCase 
{
    public function testRequest() 
    {
        require __DIR__ . '/cfgs/sms_config.php';

        if (isset($proxyHost) && isset($proxyPort))
            RestfulEnvironment::setProxy($proxyHost, $proxyPort);
        if (isset($allowAllCerts))
            RestfulEnvironment::setAcceptAllCerts($allowAllCerts);

        $osrvc = new OAuthTokenService($FQDN, $api_key, $secret_key);
        $token = $osrvc->getToken('SMS');

        $srvc = new SMSService($FQDN, $token);
        $response = $srvc->getMessages($getMsgsShortCode);
        $this->assertTrue($response->getResourceUrl() != null);

        $response = $srvc->sendSMS($phoneNumber, 'test msg ok', false); 
        $this->assertTrue($response->getMessageId() != null);

        $msgId = $response->getMessageId();
        $response = $srvc->getSMSDeliveryStatus($msgId); 
        $this->assertTrue($response->getResourceUrl() != null);
    }

}

?>
