<?php
// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/Speech/SpeechService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Speech\SpeechService;

// Use the app settings from developer.att.com for the following values.
// Make sure Speech is enabled the app key/secret.

// Enter the value from 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from 'Secret' field
$clientSecret = 'ENTER VALUE!';

// Enter path of file to translate
$fname = 'ENTER VALUE!';

// Create service for requesting an OAuth token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token
$token = $osrvc->getToken('SPEECH');

// Create service for interacting with the Speech api
$speechSrvc = new SpeechService('https://api.att.com', $token);

// Translate file
$response = $speechSrvc->speechToText($fname, 'Generic');

?>
<!DOCTYPE html>
<html>
  <head>
    <title>AT&amp;T Speech Example</title>
  </head>
  <body>
  <?php var_dump($response); ?>
  </body>
</html>
