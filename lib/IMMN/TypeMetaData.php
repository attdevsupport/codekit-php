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

require_once __DIR__ . '/SegmentationDetails.php';

use Att\Api\IMMN\IMMNSegmentationDetails;

final class IMMNTypeMetaData
{
    private $_subject;
    private $_isSegmented;
    private $_segmentationDetails;

    public function __construct($subject, $isSegmented, $segmentationDetails)
    {
        $this->_subject = $subject;
        $this->_isSegmented = $isSegmented;
        $this->_segmentationDetails = $segmentationDetails;
    }

    public function getSubject()
    {
        return $this->_subject;
    }

    public function isSegmented()
    {
        return $this->_isSegmented;
    }

    public function getSegmentationDetails()
    {
        return $this->_segmentationDetails;
    }

    public static function fromArray($arr)
    {
        $isSegmented = null;
        $segDetails = null;
        $subject = null;

        if (isset($arr['isSegmented']) && $arr['isSegmented']) {
            $isSegmented = true;
        }

        if (isset($arr['segmentationDetails'])) {
            $segDetailsArr = $arr['segmentationDetails'];
            $segDetails = IMMNSegmentationDetails::fromArray($segDetailsArr);
        }

        if (isset($arr['subject'])) {
            $subject = $arr['subject'];
        }

        return new IMMNTypeMetaData($subject, $isSegmented, $segDetails);
    }

}

?>
