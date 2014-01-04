<?php
require_once __DIR__ . '/../../lib/SMS/DeliveryStatus.php'; 

use Att\Api\SMS\DeliveryStatus;

class SMS_DeliveryStatusTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        { 
            "DeliveryInfoList": { 
                "DeliveryInfo": [ { 
                        "Id":"msg0", 
                        "Address":"+15555555992", 
                        "DeliveryStatus":"DeliveredToTerminal" 
                } ], 
                "ResourceUrl":"https://api.att.com/sms/v3/messaging/outbox/123" 
            } 
        }  
        ';

        $arr = json_decode($str, true);

        $r = DeliveryStatus::fromArray($arr);

        $this->assertEquals($r->getResourceUrl(), 'https://api.att.com/sms/v3/messaging/outbox/123');

        $di = $r->getDeliveryInfoList()[0];
        $this->assertEquals($di->getId(), 'msg0');
        $this->assertEquals($di->getAddress(), '+15555555992');
        $this->assertEquals($di->getDeliveryStatus(), 'DeliveredToTerminal');
    }

}

?>
