<?php
// This Quickstart Guide for the Advertising API requires the PHP code kit, 
// which can be found at:
// https://github.com/attdevsupport/codekit-php

// Make sure the index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/ADS/ADSService.php';
require_once __DIR__ . '/lib/ADS/Category.php';

// Use any namespaced classes.
use Att\Api\ADS\ADSService;
use Att\Api\ADS\Category;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Srvc\ServiceException;

// Use the app account settings from developer.att.com for the following values.
// Make sure that the API scope is set to ADS for the Advertising API before 
// retrieving the App Key and App Secret.

// Enter the value from the 'App Key' field obtained at developer.att.com 
// in your app account.
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field obtained at developer.att.com 
// in your app account.
$clientSecret = 'ENTER VALUE!';

// Create the service for requesting an OAuth access token.
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get the OAuth access token using the ADS API scope.
$token = $osrvc->getToken('ADS');

// Create the service for interacting with the Advertising API.
$adsSrvc = new ADSService('https://api.att.com', $token);

try {
    // Specify the user agent (must be mobile).
    $ua = 'Mozilla/5.0 (Android; Mobile; rv:13.0) Gecko/13.0 Firefox/13.0';

    // Specify a unique id.
    $udid = '938382893239492349234923493249';

    // Send the request to the API Gateway for getting an advertisement 
    // using 'auto' as the category.
    $cat = Category::AUTO;
    $response = $adsSrvc->getAdvertisement($cat, $ua, $udid);
    echo 'clickUrl: ' . $response->getClickUrl() . "\n";
    echo 'adType: ' . $response->getAdsType() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
