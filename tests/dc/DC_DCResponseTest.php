<?php
require_once __DIR__ . '/../../lib/DC/DCResponse.php'; 

use Att\Api\DC\DCResponse;

class DC_CSResponseTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        {
            "DeviceInfo": {
                "DeviceId": { 
                    "TypeAllocationCode" : "01196499" 
                }, 

                "Capabilities": { 
                    "Name" : "LGE CU920", 
                    "Vendor":  "LGE", 
                    "Model":  "CU920", 
                    "FirmwareVersion":  "CU920-MSM4090201D-V10h-FEB-05", 
                    "UaProf":     "http://gsm.lge.com/html/gsm/LG-CU920.xml", 
                    "MmsCapable":  "Y", 
                    "AssistedGps":  "Y", 
                    "LocationTechnology":  "SUPL2", 
                    "DeviceBrowser" : "safari", 
                    "WapPushCapable" : "Y" 
                } 
            }  
        }
        
        ';

        $arr = json_decode($str, true);

        $r = DCResponse::fromArray($arr);

        $dc = $r->getCapabilities();

        $this->assertEquals($r->getTypeAllocationCode(), "01196499");

        $this->assertEquals($dc->getName(), "LGE CU920");
        $this->assertEquals($dc->getVendor(), "LGE");
        $this->assertEquals($dc->getModel(), "CU920");
        $this->assertEquals($dc->getFirmwareVersion(), "CU920-MSM4090201D-V10h-FEB-05");
        $this->assertEquals($dc->getUaProf(), "http://gsm.lge.com/html/gsm/LG-CU920.xml");
        $this->assertEquals($dc->isMmsCapable(), true);
        $this->assertEquals($dc->isAssistedGps(), true);
        $this->assertEquals($dc->getLocationTechnology(), "SUPL2");
        $this->assertEquals($dc->getDeviceBrowser(), "safari");
        $this->assertEquals($dc->isWapPushCapable(), true);
    }

}
