<?php
require_once __DIR__ . '/../../lib/ADS/ADSResponse.php'; 

use Att\Api\ADS\ADSResponse;

class ADS_ADSResponseTest extends PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {

        $response = new ADSResponse(
            'http://att.com', '1', 'http://att.com', 'http://att.com', 'fds'
        );

        $this->assertEquals($response->getClickUrl(), 'http://att.com');
        $this->assertEquals($response->getADSType(), '1');
        $this->assertEquals($response->getImageUrl(), 'http://att.com');
        $this->assertEquals($response->getTrackUrl(), 'http://att.com');
        $this->assertEquals($response->getContent(), 'fds');
    }

    public function testFromArray()
    {
        $str = '
        {
            "AdsResponse": {
                "Ads": {
                    "Type": "thirdparty",
                        "ClickUrl": "http://att.com",
                        "TrackUrl": "http://att.com",
                        "Text": "",
                        "Content":"fds"
                }
            }
        }  
        ';

        $arr = json_decode($str, true);

        $r = ADSResponse::fromArray($arr);

        $this->assertEquals($r->getClickUrl(), 'http://att.com');
        $this->assertEquals($r->getADSType(), 'thirdparty');
        $this->assertTrue($r->getImageUrl() == null);
        $this->assertEquals($r->getTrackUrl(), 'http://att.com');
        $this->assertEquals($r->getContent(), 'fds');
    }

}
