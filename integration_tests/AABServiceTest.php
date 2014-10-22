<?php

require_once __DIR__ . '/../lib/AAB/ContactCommon.php'; 
require_once __DIR__ . '/../lib/AAB/AABService.php'; 
require_once __DIR__ . '/../lib/OAuth/OAuthTokenService.php'; 

use Att\Api\AAB\ContactCommon;
use Att\Api\AAB\AABService;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Restful\RestfulEnvironment;

class AABServiceTest extends PHPUnit_Framework_TestCase 
{
    private function _createContactCommon()
    {
        $contactCommon = new ContactCommon();
        $contactCommon->firstName = "fname";
        $contactCommon->middleName = "mname";
        $contactCommon->lastName = "lname";
        $contactCommon->prefix = "prefix";
        $contactCommon->suffix = "suffix";
        $contactCommon->nickname = "nickname";
        $contactCommon->organization = "org";
        $contactCommon->jobTitle = "jobTitle";
        $contactCommon->anniversary = "anniversary";
        $contactCommon->gender = "gender";
        $contactCommon->spouse = "spourse";
        $contactCommon->children = "children";
        $contactCommon->hobby = "hobby";
        $contactCommon->assistant = "assistant";

        return $contactCommon;
    }

    public function testRequest() 
    {
        require __DIR__ . '/cfgs/aab_config.php';

        if (isset($proxyHost) && isset($proxyPort))
            RestfulEnvironment::setProxy($proxyHost, $proxyPort);
        if (isset($allowAllCerts))
            RestfulEnvironment::setAcceptAllCerts($allowAllCerts);

        $osrvc = new OAuthTokenService($FQDN, $api_key, $secret_key);
        $token = $osrvc->getToken('AAB');

        $aabService = new AABService($FQDN, $token);

//        $contactCommon = $this->_createContactCommon();
//        $response = $aabService->createContact($contactCommon);
//        $this->assertTrue($response !== null);

        $response = $aabService->getContact('1234');
        $this->assertTrue($response !== null);
        $contactId = $response->getContactId();

//        $response = $aabService->getContacts();
//        $this->assertTrue($response !== null);
////
//        $response = $aabService->getContactGroups($contactId);
//        $this->assertTrue($response !== null);
    }
}

?>
