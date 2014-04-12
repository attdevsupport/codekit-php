<?php
// This quickstart guide requires the PHP codekit, which can be found at:
// https://github.com/attdevsupport/codekit-php

// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/MMS/MMSService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\MMS\MMSService;

// Use the app account settings from developer.att.com for the following values.
// Make sure MMS is enabled for the App key and App Secret.

// Enter the value from the 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field
$clientSecret = 'ENTER VALUE!';

// Create service for requesting an OAuth access token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the MMS scope
$token = $osrvc->getToken('MMS');

// Create service for interacting with the MMS API
$mmsSrvc = new MMSService('https://api.att.com', $token);

try {
    /* This portion showcases the Send MMS API call. */
    // Enter phone number that MMS will be sent to
    // For example: $number = '5555555555';
    $number = 'ENTER VALUE!';
    // Enter file path(s) of attachment to send (or null if none)
    // For example, $fnames = array('/tmp/image.gif'); or $fnames = null;
    $fnames = array('ENTER VALUE');
    // Send an MMS to the specified number with the specified attachment(s)
    $response = $mmsSrvc->sendMMS($number, $fnames);
    echo "msgId: " . $response->getMessageId() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get MMS Status API call. */
    // Enter message id for which to get status
    $msgId = 'ENTER VALUE!';
    // Send API request for getting message status
    $status = $mmsSrvc->getMMSStatus($msgId);
    echo "resourceUrl: " . $status->getResourceUrl() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
