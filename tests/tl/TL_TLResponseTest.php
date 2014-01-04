<?php
require_once __DIR__ . '/../../lib/TL/TLResponse.php'; 

use Att\Api\TL\TLResponse;

class TL_TLResponseTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        { 
            "accuracy": "719", 
            "latitude": "47.67998", 
            "longitude": "-122.14459", 
            "timestamp": "2012-09-10T11:50:14.000-05:00" 
        }  
        ';

        $arr = json_decode($str, true);

        // extra key added
        $arr['elapsedTime'] = 10;

        $r = TLResponse::fromArray($arr);

        $this->assertEquals($r->getAccuracy(), 719);
        $this->assertEquals($r->getLatitude(), 47.67998);
        $this->assertEquals($r->getLongitude(), -122.14459);
        $this->assertEquals($r->getTimestamp(), '2012-09-10T11:50:14.000-05:00');
        $this->assertEquals($r->getElapsedTime(), 10);
    }

}
