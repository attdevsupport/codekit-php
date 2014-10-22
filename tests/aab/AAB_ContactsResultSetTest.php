<?php
require_once __DIR__ . '/../../lib/AAB/ContactsResultSet.php'; 

use Att\Api\AAB\ContactsResultSet;

class AAB_ContactsResultSetTest extends PHPUnit_Framework_TestCase
{
    public function testFromArray()
    {
        $str = '
        {
            "resultSet": {
                "currentPageIndex": "2",
                "totalRecords": "2",
                "totalPages": "1",
                "previousPage": "0",
                "nextPage": "1",
                "quickContacts": {
                    "quickContact": [
                    {
                        "contactId": "12345",
                        "formattedName": "GOOD BEST BOY",
                        "firstName": "BEST",
                        "middleName": "BOY",
                        "lastName": "GOOD",
                        "prefix": "SR.",
                        "suffix": "II",
                        "nickName": "TEST",
                        "organization": "ATT",
                        "phone": {
                            "type": "HOME",
                            "number": "5555555555"
                        },
                        "address": {
                            "type": "WORK",
                            "preferred": "TRUE",
                            "poBox": "3456",
                            "addressLine1": "1234 fake street",
                            "addressLine2": "APT 456",
                            "city": "REDMOND",
                            "state": "WA",
                            "zip": "90000",
                            "country": "USA"
                        },
                        "email": {
                            "type": "WORK",
                            "emailAddress": "abc@dev.slash.null"
                        },
                        "im": {
                            "type": "ATT",
                            "imUri": "ABC"
                        }
                    }
                    ]
                }
            }
        }
        ';

        $arr = json_decode($str, true);

        $r = ContactsResultSet::fromArray($arr);
        $this->assertEquals($r->getCurrentPageIndex(), '2');
        $this->assertEquals($r->getTotalRecords(), '2');
        $this->assertEquals($r->getTotalPages(), '1');
        $this->assertEquals($r->getPreviousPage(), '0');
        $this->assertEquals($r->getNextPage(), '1');

        $qcontacts = $r->getQuickContacts();
        $qcontact = $qcontacts[0];
        $this->assertEquals($qcontact->getContactId(), '12345');
        $this->assertEquals($qcontact->getFormattedName(), 'GOOD BEST BOY');
        $this->assertEquals($qcontact->getFirstName(), 'BEST');
        $this->assertEquals($qcontact->getMiddleName(), 'BOY');
        $this->assertEquals($qcontact->getLastName(), 'GOOD');
        $this->assertEquals($qcontact->getPrefix(), 'SR.');
        $this->assertEquals($qcontact->getNickname(), 'TEST');
        $this->assertEquals($qcontact->getOrganization(), 'ATT');

        $phone = $qcontact->getPhone();
        $this->assertEquals($phone->getPhoneType(), 'HOME');
        $this->assertEquals($phone->getNumber(), '5555555555');

        $addr = $qcontact->getAddress();
        $this->assertEquals($addr->getAddressType(), 'WORK');
        $this->assertTrue($addr->isPreferred());
        $this->assertEquals($addr->getPoBox(), '3456');
        $this->assertEquals($addr->getAddressLineOne(), '1234 fake street');
        $this->assertEquals($addr->getAddressLineTwo(), 'APT 456');
        $this->assertEquals($addr->getCity(), 'REDMOND');
        $this->assertEquals($addr->getState(), 'WA');
        $this->assertEquals($addr->getZipCode(), '90000');
        $this->assertEquals($addr->getCountry(), 'USA');

        $email = $qcontact->getEmail();
        $this->assertEquals($email->getEmailType(), 'WORK');
        $this->assertEquals($email->getEmailAddress(), 'abc@dev.slash.null');

        $im = $qcontact->getIm();
        $this->assertEquals($im->getImType(), 'ATT');
        $this->assertEquals($im->getImUri(), 'ABC');

    }
}

?>
