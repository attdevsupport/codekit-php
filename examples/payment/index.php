<?php
// This quickstart guide requires the PHP codekit, which can be found at:
// https://github.com/attdevsupport/codekit-php

// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/Notary/NotaryService.php';
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/Payment/PaymentService.php';

use Att\Api\Notary\NotaryService;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Payment\PaymentService;

// Enter the value from the 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field
$clientSecret = 'ENTER VALUE!';

// Create service for requesting an OAuth access token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the Payment scope
$token = $osrvc->getToken('Payment');

// Create service for interacting with the Notary API
$notarySrvc = new NotaryService('https://api.att.com', $clientId, $clientSecret);

// Create service for interacting with the Payment API
$paymentSrvc = new PaymentService('https://api.att.com', $token);

// The following lines of code showcase the possible method calls for 
// the PaymentService class; to test only a particular method call, comment out
// any other method calls.

try {
    /* This portion showcases the Get Notary API Call. */
    // Enter value for payload
    $payload = 'ENTER VALUE!';
    // Send a request for getting notary
    $response = $notarySrvc->getNotary($payload);
    echo 'signature: ' . $response->getSignature() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get Transaction Status API call. */
    // Enter value for transaction type; e.g. $type = 'TransactionId';
    $type = 'ENTER VALUE!';
    // Enter value for transaction value
    $value = 'ENTER VALUE!';
    // Send a request for the transaction status
    $response = $paymentSrvc->getTransactionStatus($type, $value);
    echo 'transaction IsSuccess: ' . $response['IsSuccess'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get Subscription Status API call. */
    // Enter value for subscription type; e.g. $type = 'SubscriptionId';
    $type = 'ENTER VALUE!';
    // Enter value for subscription value
    $value = 'ENTER VALUE!';
    // Send a request for the subscription status
    $response = $paymentSrvc->getSubscriptionStatus($type, $value);
    echo 'subscription IsSuccess: ' . $response['IsSuccess'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get Subscription Details API call. */
    // Enter the value for the merchant subscrpition id
    $merchantSId = 'ENTER VALUE!';
    // Enter the value for the consumer id
    $consumerId = 'ENTER VALUE!';
    // Send a request for the subscription details
    $response = $paymentSrvc->getSubscriptionDetails($merchantSId, $consumerId);
    echo 'subscription details status: ' . $response['Status'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Cancel Subscription API call. */
    // Enter value for subscription id
    $subId = 'ENTER VALUE!';
    $reasonTxt= 'Example Refund!';
    // Send a request for canceling a subscription
    $response = $paymentSrvc->cancelSubscription($subId, $reasonTxt);
    echo 'cancel subscription IsSuccess: ' . $response['IsSuccess'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Refund Subscription API call. */
    // Enter value for subscription id
    $subId = 'ENTER VALUE!';
    $reasonTxt= 'Example Refund!';
    // Send a request for refunding a subscription
    $response = $paymentSrvc->refundSubscription($subId, $reasonTxt);
    echo 'refund subscription IsSuccess: ' . $response['IsSuccess'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Refund Transaction API call. */
    // Enter value for transaction id
    $transId = 'ENTER VALUE!';
    $reasonTxt= 'Example Refund!';
    // Send a request for refunding a transaction
    $response = $paymentSrvc->refundTransaction($transId, $reasonTxt);
    echo 'refund transaction id: ' . $response['TransactionId'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
