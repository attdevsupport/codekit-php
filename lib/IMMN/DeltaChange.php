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

/**
 * Immutable class used to hold a Delta object.
 *
 * @category API
 * @package  IMMN
 * @author   pk9069
 * @license  http://developer.att.com/sdk_agreement AT&amp;T License
 * @version  Release: @package_version@ 
 */
final class IMMNDeltaChange
{
    private $_msgId;
    private $_favorite;
    private $_unread;

    public function __construct($msgId, $favorite, $unread)
    {
        $this->_msgId = $msgId;
        $this->_favorite = $favorite;
        $this->_unread = $unread;
    }

    public function getMessageId()
    {
        return $this->_msgId;
    }

    public function isFavorite()
    {
        return $this->_favorite;
    }

    public function isUnread()
    {
        return $this->_unread;
    }

    public function toArray()
    {
        $arr = array();
        $arr['messageId'] = $this->getMessageId();

        if (isset($arr['isFavorite'])) {
            $arr['isFavorite'] = $this->isFavorite();
        }
        if (isset($arr['isUnread'])) {
            $arr['isUnread'] = $this->isUnread();
        }

        return $arr;
    }

    public static function fromArray($arr)
    {
        $msgId = $arr['messageId'];
        $favorite = $arr['isFavorite'];
        $unread = $arr['isUnread'];

        return new IMMNDeltaChange($msgId, $favorite, $unread);
    }
}

?>
