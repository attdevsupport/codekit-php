<?php
// This Quickstart Guide for the Speech API requires the PHP code kit, 
// which can be found at:
// https://github.com/attdevsupport/codekit-php

// Make sure that the index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/Speech/SpeechService.php';

// Use any namespaced classes.
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Speech\SpeechService;

// Use the app account settings from developer.att.com for the following values.
// Make sure that the API scope is set to SPEECH for the Speech API before 
// retrieving the App Key and App Secret.

// Enter the value from the 'App Key' field obtained at developer.att.com 
// in your app account.
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field obtained at developer.att.com 
// in your app account.
$clientSecret = 'ENTER VALUE!';

// Create the service for requesting an OAuth access token.
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get the OAuth access token.
$token = $osrvc->getToken('SPEECH');

// Create the service for interacting with the Speech API.
$speechSrvc = new SpeechService('https://api.att.com', $token);

// The Speech API requires the audio files to be certain formats. In order to
// convert speech files to the proper format, the ffmpeg program may be used.
// The ffmpeg program can be downloaded from https://ffmpeg.org/

// The following try/catch blocks can be used to test the methods of the 
// Speech API. To test a specific method, comment out the other try/catch blocks.

/* This try/catch block tests the speechToText method. */
try {
    // Enter the path of the file to translate. For example: $fname = '/tmp/file.wav';
    $fname = 'ENTER VALUE!';
    $speechContext = 'Generic';
    // Send the request to convert the speech file to text.
    $response = $speechSrvc->speechToText($fname, $speechContext);
    echo 'responseId: ' . $response->getResponseId() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the textToSpeech method. */
try {
    
    // Specify the content type.
    $ctype = 'ENTER VALUE!';
    // Specify text to convert to speech.
    $txt = 'ENTER VALUE!';
    // Send the request to convert the specified text to audio.
    $response = $speechSrvc->textToSpeech($ctype, $txt);
    echo 'audio length: ' . strlen($response) . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the speechToTextCustom method. */
try {
    
    // Enter the path of the file to translate. For example: $fname = '/tmp/file.wav';
    $fname = 'ENTER VALUE!';
    $speechContext = 'Generic';
    // Send the request to convert the speech file to text.
    $response = $speechSrvc->speechToTextCustom($speechContext, $fname);
    echo 'responseId: ' . $response->getResponseId() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
