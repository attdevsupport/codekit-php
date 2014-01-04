<?php

require_once __DIR__ . '/../lib/ADS/Category.php'; 
require_once __DIR__ . '/../lib/ADS/ADSService.php'; 
require_once __DIR__ . '/../lib/OAuth/OAuthTokenService.php'; 

use Att\Api\ADS\Category;
use Att\Api\ADS\ADSService;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Restful\RestfulEnvironment;

class ADSServiceTest extends PHPUnit_Framework_TestCase 
{
    public function testRequest() 
    {
        require __DIR__ . '/cfgs/ads_config.php';

        if (isset($proxyHost) && isset($proxyPort))
            RestfulEnvironment::setProxy($proxyHost, $proxyPort);
        if (isset($allowAllCerts))
            RestfulEnvironment::setAcceptAllCerts($allowAllCerts);

        $osrvc = new OAuthTokenService($FQDN, $api_key, $secret_key);
        $token = $osrvc->getToken('ADS');

        $adsService = new ADSService($FQDN, $token);

        $category = Category::AUTO;
        $ua = 'Mozilla/5.0 (Android; Mobile; rv:13.0) Gecko/13.0 Firefox/13.0';
        $udid = '938382893239492349234923493249';

        $response = $adsService->getAdvertisement($category, $ua, $udid);
        $this->assertTrue($response->getContent() != null);
    }

}

?>
