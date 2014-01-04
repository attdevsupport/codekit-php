<?php

require_once __DIR__ . '/../../lib/Srvc/ServiceException.php'; 

use Att\Api\Srvc\ServiceException;


class Srvc_ServiceExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $s = new ServiceException('body', 400);

        $this->assertEquals($s->getErrorResponse(), 'body');
        $this->assertEquals($s->getErrorCode(), 400);
    }
}

?>
