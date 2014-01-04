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

require_once __DIR__ . '/Delta.php';

use Att\Api\IMMN\Delta;

/**
 * Immutable class used to hold a DeltaResponse object.
 *
 * @category API
 * @package  IMMN
 * @author   pk9069
 * @license  http://developer.att.com/sdk_agreement AT&amp;T License
 * @version  Release: @package_version@ 
 */
final class DeltaResponse
{
    private $_state;
    private $_deltas;

    private function __construct($state, $deltas)
    {
        $this->_state = $state;
        $this->_deltas = $deltas;
    }

    public function getState()
    {
        return $this->_state;
    }

    public function getDeltas()
    {
        return $this->_deltas;
    }

    public static function fromArray($arr)
    {
        $deltasResponseArr = $arr['deltaResponse'];
        $state = $deltasResponseArr['state'];

        $deltas = array();
        $deltasArr = $deltasResponseArr['delta'];
        foreach($deltasArr as $deltaArr) {
            $delta = Delta::fromArray($deltaArr);
            $deltas[] = $delta;
        }

        return new DeltaResponse($state, $deltas);
    }
}

?>
