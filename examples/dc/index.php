<?php
// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/OAuth/OAuthCode.php';
require_once __DIR__ . '/lib/DC/DCService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\OAuth\OAuthCode;
use Att\Api\DC\DCService;

// Use the app settings from developer.att.com for the following values.
// Make sure DC is enabled the app key/secret.

// Enter the value from 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from 'Secret' field
$clientSecret = 'ENTER VALUE!';

// Get the OAuth code by opening a browser to the following URL:
// https://api.att.com/oauth/authorize?client_id=CLIENT_ID&scope=SCOPE&redirect_uri=REDIRECT_URI
// replacing CLIENT_ID, SCOPE, and REDIRECT_URI with the values configured at 
// developer.att.com. After authenticating, copy the oauth code from the
// browser URL.
// For DC, the internet connection must be OnNet 
// (https://developer.att.com/developer/forward.jsp?passedItemId=13200290).
$oauthCode = "ENTER VALUE!";

// Create service for requesting an OAuth token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the oauth code
$token = $osrvc->getTokenUsingCode(new OAuthCode($oauthCode));

// Create service for interacting with the DC api
$dcSrvc = new DCService('https://api.att.com', $token);

// Send a request for getting device information
$response = $dcSrvc->getDeviceInformation();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>AT&amp;T DC Example</title>
  </head>
  <body>
    typeAllocationCode: <?php echo $response->getTypeAllocationCode(); ?>
  </body>
</html>
