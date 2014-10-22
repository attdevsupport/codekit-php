<?php
require_once __DIR__ . '/../../lib/AAB/Phone.php'; 

use Att\Api\AAB\Phone;

class AAB_PhoneTest extends PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {

        $phone = new Phone('CELL', '5555555555', true);

        $this->assertEquals($phone->getPhoneType(), 'CELL');
        $this->assertEquals($phone->getNumber(), '5555555555');
        $this->assertEquals($phone->isPreferred(), true);
    }

    public function testFromArray()
    {
        $str = '
        {
            "type": "CELL",
            "number": "5555555555",
            "preferred": true
        }
        ';

        $arr = json_decode($str, true);

        $phone = Phone::fromArray($arr);

        $this->assertEquals($phone->getPhoneType(), 'CELL');
        $this->assertEquals($phone->getNumber(), '5555555555');
        $this->assertEquals($phone->isPreferred(), true);
    }

}
