<?php
require_once __DIR__ . '/../../lib/AAB/WebUrl.php'; 

use Att\Api\AAB\WebUrl;

class AAB_WebUrlTest extends PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {

        $webUrl = new WebUrl('HOME', 'http://www.att.com', true);

        $this->assertEquals($webUrl->getWebUrlType(), 'HOME');
        $this->assertEquals($webUrl->getUrl(), 'http://www.att.com');
        $this->assertEquals($webUrl->isPreferred(), true);
    }

    public function testFromArray()
    {
        $str = '
        {
            "type": "HOME",
            "url": "http://www.att.com",
            "preferred": true
        }
        ';

        $arr = json_decode($str, true);

        $webUrl = WebUrl::fromArray($arr);

        $this->assertEquals($webUrl->getWebUrlType(), 'HOME');
        $this->assertEquals($webUrl->getUrl(), 'http://www.att.com');
        $this->assertEquals($webUrl->isPreferred(), true);
    }

}
