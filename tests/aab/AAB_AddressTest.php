<?php
require_once __DIR__ . '/../../lib/AAB/Address.php'; 

use Att\Api\AAB\Address;

class AAB_AddressTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
            {
                "type": "WORK",
                "preferred": "TRUE",
                "poBox": "3456",
                "addressLine1": "345 Fake PL NE",
                "addressLine2": "APT 456",
                "city": "REDMOND",
                "state": "WA",
                "zip": "90000",
                "country": "USA"
            }
        ';

        $arr = json_decode($str, true);

        $r = Address::fromArray($arr);

        $this->assertEquals($r->getAddressType(), 'WORK');
        $this->assertEquals($r->isPreferred(), true);
        $this->assertEquals($r->getPoBox(), '3456');
        $this->assertEquals($r->getAddressLineOne(), '345 Fake PL NE');
        $this->assertEquals($r->getAddressLineTwo(), 'APT 456');
        $this->assertEquals($r->getCity(), 'REDMOND');
        $this->assertEquals($r->getState(), 'WA');
        $this->assertEquals($r->getZipCode(), '90000');
        $this->assertEquals($r->getCountry(), 'USA');
    }

}
