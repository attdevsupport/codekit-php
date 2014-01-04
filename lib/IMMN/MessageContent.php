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

final class IMMNMessageContent
{
    private $_contentType;
    private $_contentLength;
    private $_content;

    private function __construct()
    {
    }

    public function getContentType()
    {
        return $this->_contentType;
    }

    public function getContentLength()
    {
        return $this->_contentLength;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public static function fromArray($arr)
    {
        $immnMsgContent = new IMMNMessageContent();

        $immnMsgContent->_contentType = $arr['contentType'];
        $immnMsgContent->_contentLength = $arr['contentLength'];
        $immnMsgContent->_content = $arr['content'];

        return $immnMsgContent;
    }
}
