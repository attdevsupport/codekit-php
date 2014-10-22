<?php
require_once __DIR__ . '/../../lib/AAB/GroupsResultSet.php'; 

use Att\Api\AAB\GroupsResultSet;

class AAB_GroupsResultSetTest extends PHPUnit_Framework_TestCase
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
                "nextPage": "0",
                "groups": {
                    "group": [
                    {
                        "groupId": "12345",
                        "groupName": "COLLEGE",
                        "groupType": "USER"
                    }
                    ]
                }
            }
        }
        ';

        $arr = json_decode($str, true);

        $r = GroupsResultSet::fromArray($arr);
        $this->assertEquals($r->getCurrentPageIndex(), '2');
        $this->assertEquals($r->getTotalRecords(), '2');
        $this->assertEquals($r->getTotalPages(), '1');
        $this->assertEquals($r->getPreviousPage(), '0');
        $this->assertEquals($r->getNextPage(), '0');

        $groups = $r->getGroups();
        $group = $groups[0];
        $this->assertEquals($group->getGroupId(), '12345');
        $this->assertEquals($group->getGroupName(), 'COLLEGE');
        $this->assertEquals($group->getGroupType(), 'USER');

    }
}

?>
