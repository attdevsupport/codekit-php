<?php
require_once __DIR__ . '/../../lib/AAB/Contact.php'; 

use Att\Api\AAB\Contact;

class AAB_ContactTest extends PHPUnit_Framework_TestCase
{

    private function _validateValues($r)
    {
        $this->assertEquals($r->getCreationDate(), '2012-04-05T21:21:30.891Z');
        $this->assertEquals($r->getModificationDate(), "2012-04-05T21:21:30.891Z");
        $this->assertEquals($r->getFormattedName(), "Dr. Feel Ok III");

        $this->assertEquals($r->getFirstName(), "Feel");
        $this->assertEquals($r->getLastName(), "Ok");
        $this->assertEquals($r->getPrefix(), "Dr");
        $this->assertEquals($r->getSuffix(), "III");
        $this->assertEquals($r->getNickName(), "TASTE");
        $this->assertEquals($r->getOrganization(), "ATT");
        $this->assertEquals($r->getJobTitle(), "ENGG");
        $this->assertEquals($r->getAnniversary(), "03/03");
        $this->assertEquals($r->getGender(), "MALE");
        $this->assertEquals($r->getSpouse(), "NANCY");
        $this->assertEquals($r->getHobby(), "PAINTING");
        $this->assertEquals($r->getAssistant(), "PA");

        $phones = $r->getPhones();
        $this->assertEquals($phones[0]->getPhoneType(), 'HOME');
        $this->assertEquals($phones[0]->getNumber(), '5555555555');
        $this->assertEquals($phones[0]->isPreferred(), true);

        $addrs = $r->getAddresses();
        $this->assertEquals($addrs[0]->getAddressType(), 'WORK');
        $this->assertEquals($addrs[0]->isPreferred(), true);
        $this->assertEquals($addrs[0]->getPoBox(), '3456');
        $this->assertEquals($addrs[0]->getAddressLineOne(), '345 fake PL NE');
        $this->assertEquals($addrs[0]->getAddressLineTwo(), 'APT 456');
        $this->assertEquals($addrs[0]->getCity(), 'REDMOND');
        $this->assertEquals($addrs[0]->getState(), 'WA');
        $this->assertEquals($addrs[0]->getZipCode(), '90000');
        $this->assertEquals($addrs[0]->getCountry(), 'USA');

        $emails = $r->getEmails();
        $this->assertEquals($emails[0]->getEmailType(), 'WORK');
        $this->assertEquals($emails[0]->isPreferred(), true);
        $this->assertEquals($emails[0]->getEmailAddress(), 'XYZ@dev.slash.null');

        $ims = $r->getIms();
        $this->assertEquals($ims[0]->getImType(), 'AIM');
        $this->assertEquals($ims[0]->isPreferred(), true);
        $this->assertEquals($ims[0]->getImUri(), 'ABC');

        $weburls = $r->getWeburls();
        $this->assertEquals($weburls[0]->getWebUrlType(), 'HOME');
        $this->assertEquals($weburls[0]->isPreferred(), true);
        $this->assertEquals($weburls[0]->getUrl(), 'att.com');
    }

    public function testFromArray()
    {
        $str = '
        {
            "creationDate": "2012-04-05T21:21:30.891Z",
            "modificationDate": "2012-04-05T21:21:30.891Z",
            "formattedName": "Dr. Feel Ok III",
            "firstName": "Feel",
            "lastName": "Ok",
            "prefix": "Dr",
            "suffix": "III",
            "nickName": "TASTE",
            "organization": "ATT",
            "jobTitle": "ENGG",
            "anniversary": "03/03",
            "gender": "MALE",
            "spouse": "NANCY",
            "hobby": "PAINTING",
            "assistant": "PA",
            "phones": {
                "phone": [
                    {
                        "type": "HOME",
                        "number": "5555555555",
                        "preferred": "TRUE"
                    }
                ]
            },
            "addresses": {
                "address": [
                    {
                        "type": "WORK",
                        "preferred": "TRUE",
                        "poBox": "3456",
                        "addressLine1": "345 fake PL NE",
                        "addressLine2": "APT 456",
                        "city": "REDMOND",
                        "state": "WA",
                        "zip": "90000",
                        "country": "USA"
                    }
                ]
            },
            "emails": {
                "email": [
                    {
                        "type": "WORK",
                        "preferred": "TRUE",
                        "emailAddress": "XYZ@dev.slash.null"
                    }
                ]
            },
            "ims": {
                "IM": [
                    {
                        "type": "AIM",
                        "imUri": "ABC",
                        "preferred": "TRUE"
                    }
                ] 
            },
            "snapis": {
                "snapi": [
                    {
                        "type": "HOME",
                        "uri": "ARMBOOK",
                        "preferred": "TRUE"
                    }
                ]
            },
            "weburls": {
                "webUrl": [
                    {
                        "type": "HOME",
                        "url": "att.com",
                        "preferred": "TRUE"
                    }
                ]
            }
        }
        ';

        $arr = json_decode($str, true);
        $r = Contact::fromArray($arr);
        $this->_validateValues($r);

        $arr = $r->toArray();
        $r = Contact::fromArray($arr);
        $this->_validateValues($r);
    }

}
