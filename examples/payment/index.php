<?php
// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/Payment/PaymentService.php';

use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Payment\PaymentService;

// Enter the value from 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from 'Secret' field
$clientSecret = 'ENTER VALUE!';

// Create service for requesting an OAuth token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the Payment scope
$token = $osrvc->getToken('Payment');

// Enter notification id
$notificationId = 'ENTER VALUE!';

// Create service for interacting with the Payment api
$paymentSrvc = new PaymentService('https://api.att.com', $token);

// Send a request for sending a message
$response = $paymentSrvc->getNotificationInfo($notificationId);

?>
<!DOCTYPE html>
<html>
  <head>
    <title>AT&amp;T Payment Example</title>
  </head>
  <body>
    <?php var_dump($response); ?>
  </body>
</html>
