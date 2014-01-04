<?php
require_once __DIR__ . '/../../lib/SMS/DeliveryInfo.php'; 

use Att\Api\SMS\DeliveryInfo;

class SMS_DeliveryInfoTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        { 
            "Id":"msg0", 
            "Address":"+15555555992", 
            "DeliveryStatus":"DeliveredToTerminal" 
        } 
        ';

        $arr = json_decode($str, true);

        $r = DeliveryInfo::fromArray($arr);

        $this->assertEquals($r->getId(), 'msg0');
        $this->assertEquals($r->getAddress(), '+15555555992');
        $this->assertEquals($r->getDeliveryStatus(), 'DeliveredToTerminal');
    }

}

?>
