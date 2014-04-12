<?php
// This quickstart guide requires the PHP codekit, which can be found at:
// https://github.com/attdevsupport/codekit-php

// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/SMS/SMSService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\SMS\SMSService;

// Use the app account settings from developer.att.com for the following values.
// Make sure SMS is enabled for the App Key and App Secret.

// Enter the value from the 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field
$clientSecret = 'ENTER VALUE!';

// Create service for requesting an OAuth access token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the SMS scope
$token = $osrvc->getToken('SMS');

// Create service for interacting with the SMS API
$smsSrvc = new SMSService('https://api.att.com', $token);

try {
    /* This portion showcases the Send SMS API call. */
    // Enter phone number that SMS will be sent to
    // For example: $number = '5555555555';
    $number = 'ENTER VALUE!';
    // Send a SMS with the message 'Test Message' to $number and don't receive
    // status notification
    $response = $smsSrvc->sendSMS($number, 'Test Message', false);
    echo 'msgId: ' . $response->getMessageId() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get SMS Delivery Status API call. */
    // Enter SMS id used to get status
    $smsId = 'ENTER VALUE!';
    // Send API request for getting SMS delivery status
    $status = $smsSrvc->getSMSDeliveryStatus($smsId);
    echo 'resourceUrl: ' . $status->getResourceUrl() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get Messages API call. */
    // Enter shortcode used to get messages
    $shortCode = 'ENTER VALUE!';
    // Get messages sent to the specified short code
    $response = $smsSrvc->getMessages($shortCode);
    echo 'numberOfMsgs: ' . $response->getNumberOfMessages() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
