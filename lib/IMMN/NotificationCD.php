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

// immn notification connection details
final class IMMNNotificactionCD
{
    private $_uname;
    private $_pw;
    private $_httpsUrl;
    private $_wssUrl;
    private $_queues;

    public function __construct($uname, $pw, $httpsUrl, $wssUrl, $queues)
    {
        $this->_uname = $uname;
        $this->_pw = $pw;
        $this->_httpsUrl = $httpsUrl;
        $this->_wssUrl = $wssUrl;
        $this->_queues = $queues;
    }

    public function getUsername()
    {
        return $this->_uname;
    }

    public function getPassword()
    {
        return $this->_pw;
    }

    public function getHttpsUrl()
    {
        return $this->_httpsUrl;
    }

    public function getWssUrl()
    {
        return $this->_wssUrl;
    }

    public function getQueues()
    {
        return $this->_queues;
    }

    public static function fromArray($arr)
    {
        $notificationCDArr = $arr['notificationConnectionDetails'];

        $uname = $notificationCDArr['username'];
        $pw = $notificationCDArr['password'];
        $httpsUrl = $notificationCDArr['httpsUrl'];
        $wssUrl = $notificationCDArr['wssUrl'];
        $queues = $notificationCDArr['queues'];

        return new IMMNNotificactionCD(
            $uname, $pw, $httpsUrl, $wssUrl, $queues
        );
    }

}
