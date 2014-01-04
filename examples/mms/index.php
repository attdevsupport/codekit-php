<?php

// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/MMS/MMSService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\MMS\MMSService;

// Use the app settings from developer.att.com for the following values.
// Make sure MMS is enabled the app key/secret.

// Enter the value from 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from 'Secret' field
$clientSecret = 'ENTER VALUE!';

// Enter phone number that MMS will be sent to
// For example: $number = '5555555555';
$number = 'ENTER VALUE!';

// Enter file path of attachment to send (or null if none)
// For example, $fname = '/tmp/image.gif'; or $fname = null;
$fname = 'ENTER VALUE';

// Create service for requesting an OAuth token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the MMS scope
$token = $osrvc->getToken('MMS');

// Create service for interacting with the MMS api
$mmsSrvc = new MMSService('https://api.att.com', $token);

// Send an MMS to the specified number with the specified attachment
$response = $mmsSrvc->sendMMS($number, array($fname));

?>
<!DOCTYPE html>
<html>
  <head>
    <title>AT&amp;T MMS Example</title>
  </head>
  <body>
  Message Id: <?php echo htmlspecialchars($response->getMessageId()); ?>
  </body>
</html>
