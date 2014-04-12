<?php
// This quickstart guide requires the PHP codekit, which can be found at:
// https://github.com/attdevsupport/codekit-php

// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/Speech/SpeechService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Speech\SpeechService;

// Use the app account settings from developer.att.com for the following values.
// Make sure Speech is enabled for the App Key and App Secret.

// Enter the value from the 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field
$clientSecret = 'ENTER VALUE!';

// Create service for requesting an OAuth access token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth access token
$token = $osrvc->getToken('SPEECH');

// Create service for interacting with the Speech api
$speechSrvc = new SpeechService('https://api.att.com', $token);

// The Speech API requires the audio files to be certain formats. In order to
// convert speech files to the proper format, the ffmpeg program may be used,
// and can be downloaded from https://ffmpeg.org/

// The following lines of code showcase the possible method calls for 
// the SpeechService class; to test only a particular method call, comment out
// any other method calls.

try {
    /* This portion showcases the Speech to Text API Call. */
    // Enter path of file to translate; e.g. $fname = '/tmp/file.wav';
    $fname = 'ENTER VALUE!';
    $speechContext = 'Generic';
    // Send a request for converting the speech file to text
    $response = $speechSrvc->speechToText($fname, $speechContext);
    echo 'responseId: ' . $response->getResponseId() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Text To Speech API Call. */
    // Enter value for content type
    $ctype = 'ENTER VALUE!';
    // Enter text to convert to speech
    $txt = 'ENTER VALUE!';
    // Send a request for converting the specified text to audio
    $response = $speechSrvc->textToSpeech($ctype, $txt);
    echo 'audio length: ' . strlen($response) . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Speech to Text Custom API Call. */
    // Enter path of file to translate; e.g. $fname = '/tmp/file.wav';
    $fname = 'ENTER VALUE!';
    $speechContext = 'Generic';
    // Send a request for converting the speech file to text
    $response = $speechSrvc->speechToTextCustom($fname, $speechContext);
    echo 'responseId: ' . $response->getResponseId() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
