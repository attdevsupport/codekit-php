<?php
// This Quickstart Guide for the SMS API requires the PHP code kit, 
// which can be found at:
// https://github.com/attdevsupport/codekit-php

// Make sure that the index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/SMS/SMSService.php';

// Use any namespaced classes.
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\SMS\SMSService;

// Use the app account settings from developer.att.com for the following values.
// Make sure that the API scope is set to SMS for the SMS API before 
// retrieving the App Key and App Secret.

// Enter the value from the 'App Key' field obtained at developer.att.com 
// in your app account.
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field obtained at developer.att.com 
// in your app account.
$clientSecret = 'ENTER VALUE!';

// Create the service for requesting an OAuth access token.
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get the OAuth access token using the SMS scope.
$token = $osrvc->getToken('SMS');

// Create the service for interacting with the SMS API.
$smsSrvc = new SMSService('https://api.att.com', $token);

/* This try/catch block tests the sendSMS method. */
try {

    // Specify the phone number where the SMS message is sent.
    // For example: $number = '5555555555';
    $number = 'ENTER VALUE!';
    // Send the SMS message to the specified phone number and 
    // do not receive status notification.
    $response = $smsSrvc->sendSMS($number, 'Test Message', false);
    echo 'msgId: ' . $response->getMessageId() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getSMSDeliveryStatus method. */
try {
    
    // Enter the id of the SMS message.
    $smsId = 'ENTER VALUE!';
    // Send the request for getting the SMS delivery status.
    $status = $smsSrvc->getSMSDeliveryStatus($smsId);
    echo 'resourceUrl: ' . $status->getResourceUrl() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getMessages method. */
try {

    // Enter the shortcode used to get the messages.
    $shortCode = 'ENTER VALUE!';
    // Get the messages sent to the specified short code.
    $response = $smsSrvc->getMessages($shortCode);
    echo 'numberOfMsgs: ' . $response->getNumberOfMessages() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
