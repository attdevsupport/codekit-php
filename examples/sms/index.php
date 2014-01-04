<?php
// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/SMS/SMSService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\SMS\SMSService;

// Use the app settings from developer.att.com for the following values.
// Make sure SMS is enabled the app key/secret.

// Enter the value from 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from 'Secret' field
$clientSecret = 'ENTER VALUE!';

// Enter phone number that SMS will be sent to
// For example: $number = '5555555555';
$number = 'ENTER VALUE!';

// Create service for requesting an OAuth token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the SMS scope
$token = $osrvc->getToken('SMS');

// Create service for interacting with the SMS api
$smsSrvc = new SMSService('https://api.att.com', $token);

// Send a SMS with the message 'Test Message' to $number and don't receive
// status notification
$response = $smsSrvc->sendSMS($number, 'Test Message', false);

?>
<!DOCTYPE html>
<html>
  <head>
    <title>AT&amp;T SMS Example</title>
  </head>
  <body>
  <?php var_dump($response); ?>
  </body>
</html>
