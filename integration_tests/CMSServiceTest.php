<?php

require_once __DIR__ . '/../lib/CMS/CMSService.php'; 
require_once __DIR__ . '/../lib/OAuth/OAuthTokenService.php'; 
require_once __DIR__ . '/../lib/OAuth/OAuthCode.php'; 

use Att\Api\CMS\CMSService;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Restful\RestfulEnvironment;

class CMSServiceTest extends PHPUnit_Framework_TestCase 
{
    public function testRequest() 
    {
        require __DIR__ . '/cfgs/cms_config.php';

        if (isset($proxyHost) && isset($proxyPort))
            RestfulEnvironment::setProxy($proxyHost, $proxyPort);
        if (isset($allowAllCerts))
            RestfulEnvironment::setAcceptAllCerts($allowAllCerts);

        $osrvc = new OAuthTokenService($FQDN, $api_key, $secret_key);
        $token = $osrvc->getToken('CMS');

        $cmsService = new CMSService($FQDN, $token);
        $response = $cmsService->createSession(array('k' => 'v'));
        $id = $response->getId();
        $this->assertTrue($id != null && $id != "");

        $response = $cmsService->sendSignal('exit', $id);
        $status = $response->getStatus();
        $this->assertTrue($status != null);
    }

}

?>
