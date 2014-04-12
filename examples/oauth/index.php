<?php
// This quickstart guide requires the PHP codekit, which can be found at:
// https://github.com/attdevsupport/codekit-php

// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthCode.php';
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthCode;
use Att\Api\OAuth\OAuthException;
use Att\Api\OAuth\OAuthTokenService;

// Uncomment and set any proxy settings if required.
// RestfulEnvironment::setProxy('proxy.host', 8080 /* proxy port */)

// To use OAuth you must first set up an app account using developer.att.com.
// Enable the API(s) (e.g. SMS) for the App Key and App Secret that you want to
// access.

// Enter the scope(s) for the resources that you want the token to be able to
// access. All the scopes specified below must be enabled for the app key and
// secret as mentioned above. Note: it is not required to specify all the
// scopes enabled, only those that the token should have access to.
$scopes = 'ENTER_SCOPE_ONE,ENTER_SCOPE_TWO';

// Enter the value from 'App Key' field obtained at developer.att.com
$clientId = 'ENTER VALUE!';

// Enter the value from 'App Secret' field obtained at developer.att.com
$clientSecret = 'ENTER VALUE!';

// There are currently two ways to obtain a token.
// 1. Client Credentials - Does not require user authentication to use the API
// 2. Authorization Code - Requires user authentication to use the API

// Create service for requesting an OAuth token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

try {
    /* This portion showcases the Client Credentials flow. */
    // Get OAuth token using the scope(s) specified above
    $token = $osrvc->getToken($scopes);
    echo 'Client Credentials access token: ' . $token->getAccessToken() . "\n";
} catch(OAuthException $se) {
    echo $se->getErrorDescription();
}

try {
    /* This portion showcases the Authorization Code flow. */
    // Get the OAuth code by opening a browser to the following URL:
    // https://api.att.com/oauth/authorize?client_id=CLIENT_ID&scope=SCOPE&redirect_uri=REDIRECT_URI
    // replacing CLIENT_ID, SCOPE, and REDIRECT_URI with the values configured at 
    // developer.att.com. After authenticating, copy the oauth code from the
    // browser URL.
    $oauthCode = "ENTER VALUE!";
    // Get OAuth token using the oauth code
    $token = $osrvc->getTokenUsingCode(new OAuthCode($oauthCode));
    echo 'Authorization Code access token: ' . $token->getAccessToken() . "\n";
} catch(OAuthException $se) {
    echo $se->getErrorDescription();
}

?>
