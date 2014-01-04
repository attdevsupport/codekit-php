<?php
// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/CMS/CMSService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\CMS\CMSService;

// Use the app settings from developer.att.com for the following values.
// Make sure CMS is enabled the app key/secret.

// Enter the value from 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from 'Secret' field
$clientSecret = 'ENTER VALUE!';

// Create service for requesting an OAuth token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the CMS scope
$token = $osrvc->getToken('CMS');

// Create service for interacting with the CMS api
$cmsSrvc = new CMSService('https://api.att.com', $token);

// Create a session with no variables
$response = $cmsSrvc->createSession(array());

?>
<!DOCTYPE html>
<html>
  <head>
    <title>AT&amp;T CMS Example</title>
  </head>
  <body>
    success: <?php echo $response->getSuccess(); ?>
    id: <?php echo $response->getId(); ?>
  </body>
</html>
