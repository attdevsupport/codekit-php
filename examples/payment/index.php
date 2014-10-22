<?php
// This Quickstart Guide for the Payment API requires the PHP code kit, 
// which can be found at:
// https://github.com/attdevsupport/codekit-php

// Make sure that the index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/Notary/NotaryService.php';
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/Payment/PaymentService.php';

// Use any namespaced classes.
use Att\Api\Notary\NotaryService;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Payment\PaymentService;

// Use the app account settings from developer.att.com for the following values.
// Make sure that the API scope is set to Payment for the Payment API before 
// retrieving the App Key and App Secret.

// Enter the value from the 'App Key' field obtained at developer.att.com 
// in your app account.
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field obtained at developer.att.com 
// in your app account.
$clientSecret = 'ENTER VALUE!';

// Create the service for requesting an OAuth access token.
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get the OAuth access token using the Payment scope.
$token = $osrvc->getToken('Payment');

// Create the service for interacting with the Notary API
$notarySrvc = new NotaryService('https://api.att.com', $clientId, $clientSecret);

// Create the service for interacting with the Payment API
$paymentSrvc = new PaymentService('https://api.att.com', $token);

// The following try/catch blocks can be used to test the methods of the 
// Payment API. To test a specific method, comment out the other try/catch blocks.

/* This try/catch block tests the getNotary method. */
try {
    // Specify the payload.
    $payload = 'ENTER VALUE!';
    // Send the request for getting the notary.
    $response = $notarySrvc->getNotary($payload);
    echo 'signature: ' . $response->getSignature() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getTransactionStatus method. */
try {
    // Specify the transaction type. For example: $type = 'TransactionId';
    $type = 'ENTER VALUE!';
    // Specify the transaction value.
    $value = 'ENTER VALUE!';
    // Send the request for the transaction status.
    $response = $paymentSrvc->getTransactionStatus($type, $value);
    echo 'transaction IsSuccess: ' . $response['IsSuccess'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getSubscriptionStatus method. */
try {
    // Specify the subscription type. For example: $type = 'SubscriptionId';
    $type = 'ENTER VALUE!';
    // Specify the subscription value.
    $value = 'ENTER VALUE!';
    // Send the request for getting the subscription status.
    $response = $paymentSrvc->getSubscriptionStatus($type, $value);
    echo 'subscription IsSuccess: ' . $response['IsSuccess'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getSubscriptionDetails method. */
try {
    // Specify the id of the merchant subscription.
    $merchantSId = 'ENTER VALUE!';
    // Specify the id of the consumer.
    $consumerId = 'ENTER VALUE!';
    // Send the request for getting the subscription details.
    $response = $paymentSrvc->getSubscriptionDetails($merchantSId, $consumerId);
    echo 'subscription details status: ' . $response['Status'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the cancelSubscription method. */
try {
    // Specify the id of the subscription.
    $subId = 'ENTER VALUE!';
    $reasonTxt = 'Example Refund!';
    // Send the request to cancel the subscription.
    $response = $paymentSrvc->cancelSubscription($subId, $reasonTxt);
    echo 'cancel subscription IsSuccess: ' . $response['IsSuccess'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the refundSubscription method. */
try {
    // Specify the id of the subscription.
    $subId = 'ENTER VALUE!';
    $reasonTxt = 'Example Refund!';
    // Send the request to refund the subscription.
    $response = $paymentSrvc->refundSubscription($subId, $reasonTxt);
    echo 'refund subscription IsSuccess: ' . $response['IsSuccess'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the refundTransaction method. */
try {
    // Specify the id of the transaction.
    $transId = 'ENTER VALUE!';
    $reasonTxt = 'Example Refund!';
    // Send the request to refund the transaction.
    $response = $paymentSrvc->refundTransaction($transId, $reasonTxt);
    echo 'refund transaction id: ' . $response['TransactionId'] . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
