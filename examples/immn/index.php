<?php
// This Quickstart Guide for the In-App Messaging API requires the PHP code kit, 
// which can be found at:
// https://github.com/attdevsupport/codekit-php

// Make sure that the index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/OAuth/OAuthCode.php';
require_once __DIR__ . '/lib/IMMN/IMMNService.php';

// Use any namespaced classes.
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\OAuth\OAuthCode;
use Att\Api\IMMN\IMMNService;
use Att\Api\IMMN\IMMNDeltaChange;

// Use the app account settings from developer.att.com for the following values.
// Make sure that the API scope is set to IMMN for the In-App Messaging API before 
// retrieving the App Key and App Secret.

// Enter the value from the 'App Key' field obtained at developer.att.com 
// in your app account.
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field obtained at developer.att.com 
// in your app account.
$clientSecret = 'ENTER VALUE!';

// Get the OAuth code by opening a browser to the following URL:
// https://api.att.com/oauth/v4/authorize?client_id=CLIENT_ID&scope=SCOPE&redirect_uri=REDIRECT_URI
// replacing CLIENT_ID, SCOPE, and REDIRECT_URI with the values configured at
// developer.att.com. 
// After authenticating, copy the OAuth code from the browser URL.
$oauthCode = "ENTER VALUE!";

// Create the service for requesting an OAuth access token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get the OAuth token using the OAuth code.
$token = $osrvc->getTokenUsingCode(new OAuthCode($oauthCode));

// Create the service for interacting with the In-App Messaging API.
$immnSrvc = new IMMNService('https://api.att.com', $token);

// The following lines of code can be used to test the method calls for
// the IMMNService class. To test a specific method, comment out
// the other method.

/* This try/catch block tests the sendMessage method. */
try {
    // Specify the address to where the message is sent.
    $addr = array('ENTER VALUE!');
    // Send a test message.
    $response = $immnSrvc->sendMessage($addr, 'Text', 'Subject');
    echo "msgId: " . $response . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getMessageList method.*/
try {
    // Enter the number of messages to include in the list.
    $limit = 'ENTER VALUE!';
    // Enter the offset to the first message.
    $offset = 'ENTER VALUE!';
    // Send the request to get the message list.
    $msgList = $immnSrvc->getMessageList($limit, $offset);
    echo "total: " . $msgList->getTotal() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getMessage method. */
try {
    // Specify the id of the message to retrieve.
    $msgId = 'ENTER VALUE!';
    // Send the request to get the message.
    $msg = $immnSrvc->getMessage($msgId);
    echo "msgId: " . $msg->getMessageId() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getMessageContent method. */
try {
    // Enter the id of the message.
    $msgId = 'ENTER VALUE!';
    // Enter the id of the content to retrieve.
    $partId = 'ENTER VALUE!';
    // Send the request to get the message content.
    $msgContent = $immnSrvc->getMessageContent($msgId, $partId);
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getMessagesDelta method. */
try {
    // Enter message state.
    $state = 'ENTER VALUE!';
    // Send the request to get the delta of the messages.
    $msgsDelta = $immnSrvc->getMessagesDelta($state);
    echo "state: " . $msgsDelta->getState() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the updateMessages method. */
try {
    // Specify the id of the message to update.
    $msgId = 'ENTER VALUE';
    // Update the message's Favorite status to true.
    $favorite = true;
    // Update the message's Unread status to true.
    $unread = true;
    // Create an array that contains an IMMNDeltaChange object to pass to the
    // IMMNService object.
    $immnDeltaChange = array(new IMMNDeltaChange($msgId, $favorite, $unread));
    // Send the request to update the messages.
    $immnSrvc->updateMessages($immnDeltaChange);
    echo "Successfully updated messages.\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the updateMessage method. */
try {
    $msgId = 'ENTER VALUE';
    // Update the message's Favorite status to true.
    $favorite = true;
    // Update the message's Unread status to true.
    $unread = true;
    // Send the request to update the message.
    $immnSrvc->updateMessage($msgId, $unread, $favorite);
    echo "Successfully updated message.\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the deleteMessages method. */
try {
    // Enter the ids of the messages to delete.
    $msgIds = array('ENTER VALUE!');
    // Send the request to delete the specified messages.
    $immnSrvc->deleteMessages($msgIds);
    echo "Successfully deleted messages.\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}


/* This try/catch block tests the createMessageIndex method. */
try {
    // Send the request to create the message index.
    $immnSrvc->createMessageIndex();
    echo "Successfully created message index.\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getMessageIndexInfo method. */
try {
    // Send the request to get the message index info.
    $msgIndexInfo = $immnSrvc->getMessageIndexInfo();
    echo 'state: ' . $msgIndexInfo->getState() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

/* This try/catch block tests the getNotificationConnectionDetails method. */
try {
    // Enter queues value.
    $queues = 'ENTER VALUE!';
    // Send the request to get the notification connection details.
    $details = $immnSrvc->getNotificationConnectionDetails($queues);
    echo 'username: ' . $details->getUsername(). "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
