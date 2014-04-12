<?php
// This quickstart guide requires the PHP codekit, which can be found at:
// https://github.com/attdevsupport/codekit-php

// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/OAuth/OAuthCode.php';
require_once __DIR__ . '/lib/DC/DCService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\OAuth\OAuthCode;
use Att\Api\DC\DCService;
use Att\Api\Srvc\ServiceException;

// Use the app account settings from developer.att.com for the following values.
// Make sure DC is enabled for the App Key and App Secret.

// Enter the value from the 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field
$clientSecret = 'ENTER VALUE!';

// Get the OAuth code by opening a browser to the following URL:
// https://api.att.com/oauth/authorize?client_id=CLIENT_ID&scope=SCOPE&redirect_uri=REDIRECT_URI
// replacing CLIENT_ID, SCOPE, and REDIRECT_URI with the values configured at 
// developer.att.com. After authenticating, copy the oauth code from the
// browser URL.
// For DC, the internet connection must be OnNet 
// (https://developer.att.com/developer/forward.jsp?passedItemId=13200290).
$oauthCode = "ENTER VALUE!";

// Create service for requesting an OAuth access token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the oauth code
$token = $osrvc->getTokenUsingCode(new OAuthCode($oauthCode));

// Create service for interacting with the Device Capabilities API
$dcSrvc = new DCService('https://api.att.com', $token);

try {
    // Send a request for getting device information
    $response = $dcSrvc->getDeviceInformation();
    echo 'typeAllocationCode: ' . $response->getTypeAllocationCode() . "\n"; 
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
