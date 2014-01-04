<?php
// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/OAuth/OAuthCode.php';
require_once __DIR__ . '/lib/IMMN/IMMNService.php';

// Use the app settings from developer.att.com for the following values.
// Make sure IMMN is enabled the app key/secret.

// Enter the value from 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from 'Secret' field
$clientSecret = 'ENTER VALUE!';

// Get the OAuth code by opening a browser to the following URL:
// https://api.att.com/oauth/authorize?client_id=CLIENT_ID&scope=SCOPE&redirect_uri=REDIRECT_URI
// replacing CLIENT_ID, SCOPE, and REDIRECT_URI with the values configured at 
// developer.att.com. After authenticating, copy the oauth code from the
// browser URL.
$oauthCode = "ENTER VALUE!";

// Enter address to send message to
$addr = array('ENTER VALUE!');

// Enter message text
$txt = 'ENTER VALUE!';

// Enter message subject
$subject = 'ENTER VALUE!';

// Create service for requesting an OAuth token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the oauth code
$token = $osrvc->getTokenUsingCode(new OAuthCode($oauthCode));

// Create service for interacting with the IMMN api
$immnSrvc = new IMMNService('https://api.att.com', $token);

// Send a request for sending a message
$response = $immnSrvc->sendMessage($addresses, $txt, $subject);

?>
<!DOCTYPE html>
<html>
  <head>
    <title>AT&amp;T IMMN Example</title>
  </head>
  <body>
    <?php var_dump($response); ?>
  </body>
</html>
