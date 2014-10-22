<?php
// This Quickstart Guide requires the PHP code kit, which can be found at:
// https://github.com/attdevsupport/codekit-php

// Make sure that the index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthCode.php';
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';

// Use any namespaced classes
use Att\Api\OAuth\OAuthCode;
use Att\Api\OAuth\OAuthException;
use Att\Api\OAuth\OAuthTokenService;

// If a proxy is required, uncomment the following line to set the proxy.
// RestfulEnvironment::setProxy('proxy.host', 8080 /* proxy port */)

// To use OAuth you must first set up an app account using developer.att.com.
// Enable the APIs (for example: SMS) for the App Key and App Secret that you 
// want to access.

// Enter the API scopes for the resources that you want the token to access.
// All the scopes specified below must be enabled for the App Key and
// App Secret as mentioned above. Note: it is not required to specify all the
// scopes of all the enabled APIs, only those that the token should have access to.
$scopes = 'ENTER_SCOPE_ONE,ENTER_SCOPE_TWO';

// Enter the value from the 'App Key' field obtained at developer.att.com 
// in your app account.
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field obtained at developer.att.com 
// in your app account.
$clientSecret = 'ENTER VALUE!';

// The OAuth access token can be obtained in the following ways.
// Client Credentials - Does not require user authentication to use the API.
// Authorization Code - Requires user authentication to use the API.

// Create the service for requesting an OAuth access token.
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

/* This try/catrch block shows the Client Credentials flow. */
try {
    
    // Get the OAuth access token using the previously specified scopes.
    $token = $osrvc->getToken($scopes);
    echo 'Client Credentials access token: ' . $token->getAccessToken() . "\n";
} catch(OAuthException $se) {
    echo $se->getErrorDescription();
}

/* This try/catch block shows the Authorization Code flow. */
try {
    // Get the OAuth code by opening a browser to the following URL:
    // https://api.att.com/oauth/v4/authorize?client_id=CLIENT_ID&scope=SCOPE&redirect_uri=REDIRECT_URI
    // replacing CLIENT_ID, SCOPE, and REDIRECT_URI with the values configured at
    // developer.att.com. 
    // After authenticating, copy the OAuth code from the browser URL.
    $oauthCode = "ENTER VALUE!";
    // Get the OAuth access token using the OAuth code.
    $token = $osrvc->getTokenUsingCode(new OAuthCode($oauthCode));
    echo 'Authorization Code access token: ' . $token->getAccessToken() . "\n";
} catch(OAuthException $se) {
    echo $se->getErrorDescription();
}

?>

    
