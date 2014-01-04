<?php
require_once __DIR__ . '/../../lib/MMS/Status.php'; 

use Att\Api\MMS\Status;

class MMS_StatusTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        { 
            "DeliveryInfoList": { 
                "DeliveryInfo": [ 
                {  
                    "Id" : "msg0", 
                        "Address" : "tel:5555555992", 
                        "DeliveryStatus" : "DeliveredToTerminal" 
                } 
                ], 
                "ResourceUrl": "https://api.att.com/mms/v3/messaging/outbox/123"
            }
        } 
        ';

        $arr = json_decode($str, true);

        $r = Status::fromArray($arr);
        $this->assertEquals($r->getResourceUrl(), 'https://api.att.com/mms/v3/messaging/outbox/123');

        $di = $r->getDeliveryInfoList()[0];
        $this->assertEquals($di->getId(), 'msg0');
        $this->assertEquals($di->getAddress(), 'tel:5555555992');
        $this->assertEquals($di->getDeliveryStatus(), 'DeliveredToTerminal');
    }

}
