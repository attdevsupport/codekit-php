<?php
// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/ADS/ADSService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\ADS\ADSService;

// Use the app settings from developer.att.com for the following values.
// Make sure ADS is enabled the app key/secret.

// Enter the value from 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from 'Secret' field
$clientSecret = 'ENTER VALUE!';

// Create service for requesting an OAuth token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the ADS scope
$token = $osrvc->getToken('ADS');

// User agent (must be mobile)
$ua = 'Mozilla/5.0 (Android; Mobile; rv:13.0) Gecko/13.0 Firefox/13.0';

// Random unique value
$udid = '938382893239492349234923493249';

// Create service for interacting with the ADS api
$adsSrvc = new ADSService('https://api.att.com', $token);

// Send a request to the API for getting an advertisement using 'auto' as the
// category.
$response = $adsSrvc->getAdvertisement('auto', $ua, $udid);

?>
<!DOCTYPE html>
<html>
  <head>
    <title>AT&amp;T ADS Example</title>
  </head>
  <body>
    clickUrl: <?php echo $response->getClickUrl(); ?>
    adType: <?php echo $response->getAdsType(); ?>
  </body>
</html>
