<?php

require_once __DIR__ . '/../../lib/Srvc/Service.php'; 
require_once __DIR__ . '/../../lib/Restful/RestfulResponse.php'; 

use Att\Api\Srvc\Service;
use Att\Api\Restful\RestfulResponse;

class Srvc_ServiceTest extends PHPUnit_Framework_TestCase
{

    public function testParseJson()
    {
        $body = '{}';

        $r = new RestfulResponse($body, 204, array());

        try {
            Service::parseJson($r); // should throw exception
            $this->assertTrue(false);
        } catch (Exception $e) {}

        try {
            $codes = array(200, 204);
            Service::parseJson($r, $codes); // should NOT throw exception
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
    }

}

?>
