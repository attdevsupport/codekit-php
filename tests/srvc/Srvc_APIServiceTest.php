<?php

require_once __DIR__ . '/../../lib/Srvc/APIService.php'; 
require_once __DIR__ . '/../../lib/OAuth/OAuthToken.php'; 

use Att\Api\Srvc\APIService;
use Att\Api\OAuth\OAuthToken;

final class FakeApiService extends APIService
{
    public function __construct($fqdn, OAuthToken $token)
    {
        parent::__construct($fqdn, $token);
    }

    public function getFqdnWrapper()
    {
        return $this->getFqdn();
    }

    public function getTokenWrapper()
    {
        return $this->getToken(); 
    }
}

class Srvc_APIServiceTest extends PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $fqdn = 'http://att.com';
        $token = new OAuthToken('', OAuthToken::NO_EXPIRATION, '');
        $f = new FakeApiService($fqdn, $token);

        $this->assertEquals($f->getFqdnWrapper(), $fqdn);
        $this->assertTrue($f->getTokenWrapper() != null);
    }
}

?>
