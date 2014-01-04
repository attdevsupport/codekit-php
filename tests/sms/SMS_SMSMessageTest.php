<?php
require_once __DIR__ . '/../../lib/SMS/SMSMessage.php'; 

use Att\Api\SMS\SMSMessage;

class SMS_SMSMessageTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        { 
            "MessageId":"msg0", 
            "Message":"Hello", 
            "SenderAddress":"tel:5555551234" 
        } 
        ';

        $arr = json_decode($str, true);

        $r = SMSMessage::fromArray($arr);

        $this->assertEquals($r->getMessageId(), 'msg0');
        $this->assertEquals($r->getMessage(), 'Hello');
        $this->assertEquals($r->getSenderAddress(), 'tel:5555551234');
    }

}
