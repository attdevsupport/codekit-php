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

final class IMMNMmsContent
{
    private $_contentName;
    private $_contentUrl;
    private $_contentType;
    private $_type;

    public function __construct($contentName, $contentType, $contentUrl, $type)
    {
        $this->_contentName = $contentName;
        $this->_contentType = $contentType;
        $this->_contentUrl = $contentUrl;
        $this->_type = $type;
    }

    public function getContentName()
    {
        return $this->_contentName;
    }

    public function getContentUrl()
    {
        return $this->_contentUrl;
    }

    public function getContentType()
    {
        return $this->_contentType;
    }

    public function getMessageType()
    {
        return $this->_type;
    }

    public static function fromArray($arr)
    {
        $cname = $arr['contentName'];
        $ctype = $arr['contentType'];
        $curl = $arr['contentUrl'];
        $type = $arr['type'];

        $content = new IMMNMmsContent($cname, $ctype, $curl, $type);
    }

}

?>
