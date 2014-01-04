<?php
require_once __DIR__ . '/../../lib/MMS/DeliveryInfo.php'; 

use Att\Api\MMS\DeliveryInfo;

class MMS_DeliveryInfoTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        { 
            "Id" : "msg0", 
            "Address" : "tel:3500000992", 
            "DeliveryStatus" : "DeliveredToTerminal" 
        }  
        ';

        $arr = json_decode($str, true);

        $r = DeliveryInfo::fromArray($arr);

        $this->assertEquals($r->getId(), 'msg0');
        $this->assertEquals($r->getAddress(), 'tel:3500000992');
        $this->assertEquals($r->getDeliveryStatus(), 'DeliveredToTerminal');
    }

}
