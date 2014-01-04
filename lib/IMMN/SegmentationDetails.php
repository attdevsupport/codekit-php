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

final class IMMNSegmentationDetails
{
    private $_segmentationMsgRefNumber;
    private $_totalNumberOfParts;
    private $_thisPartNumber;

    public function __construct($refNumber, $numParts, $partNumb)
    {
        $this->_segmentationMsgRefNumber = $refNumber;
        $this->_totalNumberOfParts = $numParts;
        $this->_thisPartNumber = $partNumb;
    }

    public function getSegmentationMsgRefNumber()
    {
        return $this->_segmentationMsgRefNumber;
    }

    public function getTotalNumberOfParts()
    {
        return $this->_totalNumberOfParts;
    }

    public function getThisPartNumber()
    {
        return $this->_thisPartNumber;
    }

    public static function fromArray($arr)
    {
        $refNumber = $arr['segmentationMsgRefNumber'];
        $numParts = $arr['totalNumberOfParts'];
        $partNumb = $arr['thisPartNumber'];

        return new IMMNSegmentationDetails($refNumber, $numParts, $partNumb);
    }

}

?>
