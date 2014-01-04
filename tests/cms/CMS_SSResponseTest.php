<?php
require_once __DIR__ . '/../../lib/CMS/SSResponse.php'; 

use Att\Api\CMS\SSResponse;

class CMS_SSResponseTest extends PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {

        $response = new SSResponse('QUEUED');

        $this->assertEquals($response->getStatus(), 'QUEUED');
    }

    public function testFromArray()
    {
        $str = '
        {
            "status" : "QUEUED"
        }  
        ';

        $arr = json_decode($str, true);
        $r = SSResponse::fromArray($arr);
        $this->assertEquals($r->getStatus(), 'QUEUED');
    }

}
