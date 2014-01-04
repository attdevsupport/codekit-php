<?php
require_once __DIR__ . '/../../lib/SMS/GetSMSResponse.php'; 

use Att\Api\SMS\GetSMSResponse;

class SMS_GetSMSResponseTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        { 
            "InboundSmsMessageList": { 
                "InboundSmsMessage": [ 
                    { 
                        "MessageId":"msg0", 
                        "Message":"Hello", 
                        "SenderAddress":"tel:5555551234" 
                    } 
                ], 
                "NumberOfMessagesInThisBatch":"1", 
                "ResourceUrl":"http://api.att.com/sms/v3/messaging/inbox/123", 
                "TotalNumberOfPendingMessages":"0" 
            } 
        }  
        ';

        $arr = json_decode($str, true);

        $r = GetSMSResponse::fromArray($arr);

        $this->assertEquals($r->getNumberOfMessages(), 1);
        $this->assertEquals($r->getResourceUrl(), 'http://api.att.com/sms/v3/messaging/inbox/123');
        $this->assertEquals($r->getNumberOfPendingMessages(), 0);

        $msg = $r->getMessages()[0];
        $this->assertEquals($msg->getMessageId(), 'msg0');
        $this->assertEquals($msg->getMessage(), 'Hello');
        $this->assertEquals($msg->getSenderAddress(), 'tel:5555551234');
    }

}

?>
