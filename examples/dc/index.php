<?php
// This Quickstart Guide for the Device Capabilities API requires the PHP code kit, 
// which can be found at:
// https://github.com/attdevsupport/codekit-php

// Make sure that the index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/OAuth/OAuthCode.php';
require_once __DIR__ . '/lib/DC/DCService.php';

// Use any namespaced classes.
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\OAuth\OAuthCode;
use Att\Api\DC\DCService;
use Att\Api\Srvc\ServiceException;

// Use the app account settings from developer.att.com for the following values.
// Make sure that the API scope is set to DC for the Device Capabilities API before 
// retrieving the App Key and App Secret.

// Enter the value from the 'App Key' field obtained at developer.att.com 
// in your app account.
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field obtained at developer.att.com 
// in your app account.
$clientSecret = 'ENTER VALUE!';

// Get the OAuth code by opening a browser to the following URL:
// https://api.att.com/oauth/v4/authorize?client_id=CLIENT_ID&scope=SCOPE&redirect_uri=REDIRECT_URI
// replacing CLIENT_ID, SCOPE, and REDIRECT_URI with the values configured at
// developer.att.com.
//  
// After authenticating, copy the OAauth code from the browser URL. For the 
// Device Capabilities API, the internet connection must be OnNet
// (https://developer.att.com/developer/forward.jsp?passedItemId=13200290).
$oauthCode = "ENTER VALUE!";

// Create the service for requesting an OAuth access token.
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get the OAuth access token using the OAuth code.
$token = $osrvc->getTokenUsingCode(new OAuthCode($oauthCode));

// Create the service for interacting with the Device Capabilities API.
$dcSrvc = new DCService('https://api.att.com', $token);

try {
    // Send a request for getting the device information.
    $response = $dcSrvc->getDeviceInformation();
    echo 'typeAllocationCode: ' . $response->getTypeAllocationCode() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
