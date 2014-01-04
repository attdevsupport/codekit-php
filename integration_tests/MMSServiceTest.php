<?php

require_once __DIR__ . '/../lib/MMS/MMSService.php'; 
require_once __DIR__ . '/../lib/OAuth/OAuthTokenService.php'; 

use Att\Api\OAuth\OAuthToken;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Restful\RestfulEnvironment;
use Att\Api\MMS\MMSService;

class MMSServiceTest extends PHPUnit_Framework_TestCase 
{
    public function testRequest() 
    {
        require __DIR__ . '/cfgs/mms_config.php';

        if (isset($proxyHost) && isset($proxyPort))
            RestfulEnvironment::setProxy($proxyHost, $proxyPort);
        if (isset($allowAllCerts))
            RestfulEnvironment::setAcceptAllCerts($allowAllCerts);

        $osrvc = new OAuthTokenService($FQDN, $api_key, $secret_key);
        $token = $osrvc->getToken('MMS');

        $mmsService = new MMSService($FQDN, $token);

        $gifDir = __DIR__ . '/files/att.gif';	
        $response = $mmsService->sendMMS($phoneNumber, array($gifDir));
        $this->assertTrue($response->getMessageId() != null);
        
        $mmsId = $response->getMessageId();
        $response = $mmsService->getMMSStatus($mmsId);
        $this->assertTrue($response->getResourceUrl() != null);
        $this->assertTrue(is_array($response->getDeliveryInfoList()));
    }

}

?>
