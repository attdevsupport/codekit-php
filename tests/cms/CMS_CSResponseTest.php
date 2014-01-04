<?php
require_once __DIR__ . '/../../lib/CMS/CSResponse.php'; 

use Att\Api\CMS\CSResponse;

class CMS_CSResponseTest extends PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {

        $response = new CSResponse(true, 'id');

        $this->assertEquals($response->getSuccess(), true);
        $this->assertEquals($response->getId(), 'id');
    }

    public function testFromArray()
    {
        $str = '
        {
            "success" : true,
            "id": "id"
        }  
        ';

        $arr = json_decode($str, true);

        $r = CSResponse::fromArray($arr);

        $this->assertEquals($r->getSuccess(), true);
        $this->assertEquals($r->getId(), 'id');
    }

}
