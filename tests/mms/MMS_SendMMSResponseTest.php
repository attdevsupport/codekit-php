<?php
require_once __DIR__ . '/../../lib/MMS/SendMMSResponse.php'; 

use Att\Api\MMS\SendMMSResponse;

class MMS_SendMMsResponse extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        {
            "outboundMessageResponse":{
                "messageId":"msg0",
                    "resourceReference":{
                        "resourceURL":"https://api.att.com/mms/v3/messaging/outbox/123"
                    }
            }
        }  
        ';

        $arr = json_decode($str, true);

        $r = SendMMSResponse::fromArray($arr);
        $this->assertEquals($r->getResourceUrl(), 'https://api.att.com/mms/v3/messaging/outbox/123');
        $this->assertEquals($r->getMessageId(), 'msg0');

    }

}
