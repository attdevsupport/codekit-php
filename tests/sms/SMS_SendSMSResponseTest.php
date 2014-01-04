<?php
require_once __DIR__ . '/../../lib/SMS/SendSMSResponse.php'; 

use Att\Api\SMS\SendSMSResponse;

class SMS_SendSMSResponse extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        {
            "outboundSMSResponse": {
                "messageId":"msg0",
                "resourceReference": {
                    "resourceURL":"https://api.att.com/sms/v3/messaging/outbox/123"
                }
            }
        }  
        ';

        $arr = json_decode($str, true);

        $r = SendSMSResponse::fromArray($arr);

        $this->assertEquals($r->getMessageId(), 'msg0');
        $this->assertEquals($r->getResourceUrl(), 'https://api.att.com/sms/v3/messaging/outbox/123');
    }

}
