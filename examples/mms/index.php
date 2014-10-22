<?php
// This Quickstart Guide for the MMS API requires the PHP code kit, 
// which can be found at:
// https://github.com/attdevsupport/codekit-php

// Make sure the index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/MMS/MMSService.php';

// Use any namespaced classes.
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\MMS\MMSService;

// Use the app account settings from developer.att.com for the following values.
// Make sure that the API scope is set to MMS for the MMS API before 
// retrieving the App Key and App Secret.

// Enter the value from the 'App Key' field obtained at developer.att.com 
// in your app account.
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field obtained at developer.att.com 
// in your app account.
$clientSecret = 'ENTER VALUE!';

// Create the service for requesting an OAuth access token.
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get the OAuth access token using the MMS scope.
$token = $osrvc->getToken('MMS');

// Create the service for interacting with the MMS API.
$mmsSrvc = new MMSService('https://api.att.com', $token);

/* This try/catch block tests the sendMMS method. */
try {
    // Specify the phone number where the message is sent. 
    // For example: final String pn = "5555555555";
    $number = 'ENTER VALUE!';
    // Specify the file name and path for any attachment (or null if none).
    // For example: $fnames = array('/tmp/image.gif');
    // For example: $fnames = null;
    $fnames = array('ENTER VALUE');
    // Send the MMS message to the specified number with the specified attachment(s).
    $response = $mmsSrvc->sendMMS($number, $fnames);
    echo "msgId: " . $response->getMessageId() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getMMSStatus method. */
try {
    // Enter the id of the message for which to get the status.
    $msgId = 'ENTER VALUE!';
    // Send the request for getting message status.
    $status = $mmsSrvc->getMMSStatus($msgId);
    echo "resourceUrl: " . $status->getResourceUrl() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
