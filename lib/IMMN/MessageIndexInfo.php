<?php
namespace Att\Api\IMMN;

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 */

/**
 * IMMN Library
 * 
 * PHP version 5.4+
 * 
 * LICENSE: Licensed by AT&T under the 'Software Development Kit Tools 
 * Agreement.' 2013. 
 * TERMS AND CONDITIONS FOR USE, REPRODUCTION, AND DISTRIBUTIONS:
 * http://developer.att.com/sdk_agreement/
 *
 * Copyright 2013 AT&T Intellectual Property. All rights reserved.
 * For more information contact developer.support@att.com
 * 
 * @category  API
 * @package   IMMN
 * @author    pk9069
 * @copyright 2013 AT&T Intellectual Property
 * @license   http://developer.att.com/sdk_agreement AT&amp;T License
 * @link      http://developer.att.com
 */

final class IMMNMessageIndexInfo
{
    private $_status;
    private $_state;
    private $_msgCount;

    public function __construct($status, $state, $msgCount)
    {
        $this->_status = $status;
        $this->_state = $state;
        $this->_msgCount = $msgCount;
    }

    public function getStatus()
    {
        return $this->_status;
    }

    public function getState()
    {
        return $this->_state;
    }
    
    public function getMessagecount()
    {
        return $this->_msgCount;
    }

    public static function fromArray($arr)
    {
        $msgIndexInfoArr = $arr['messageIndexInfo'];

        $status = $msgIndexInfoArr['status'];
        $state = $msgIndexInfoArr['state'];
        $msgCount = $msgIndexInfoArr['messageCount'];

        return new IMMNMessageIndexInfo($status, $state, $msgCount);
    }
}

?>
