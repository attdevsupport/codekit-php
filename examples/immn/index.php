<?php
// This quickstart guide requires the PHP codekit, which can be found at:
// https://github.com/attdevsupport/codekit-php

// make sure this index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/OAuth/OAuthCode.php';
require_once __DIR__ . '/lib/IMMN/IMMNService.php';

// use any namespaced classes
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\OAuth\OAuthCode;
use Att\Api\IMMN\IMMNService;
use Att\Api\IMMN\IMMNDeltaChange;

// Use the app account settings from developer.att.com for the following values.
// Make sure IMMN is enabled for the App key and App Secret.

// Enter the value from the 'App Key' field
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field
$clientSecret = 'ENTER VALUE!';

// Get the OAuth code by opening a browser to the following URL:
// https://api.att.com/oauth/authorize?client_id=CLIENT_ID&scope=SCOPE&redirect_uri=REDIRECT_URI
// replacing CLIENT_ID, SCOPE, and REDIRECT_URI with the values configured at 
// developer.att.com. After authenticating, copy the oauth code from the
// browser URL.
$oauthCode = "ENTER VALUE!";

// Create service for requesting an OAuth access token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get OAuth token using the oauth code
$token = $osrvc->getTokenUsingCode(new OAuthCode($oauthCode));

// Create service for interacting with the IMMN api
$immnSrvc = new IMMNService('https://api.att.com', $token);

// The following lines of code showcase all the possible method calls for 
// the IMMNService class; to test only a particular method call, comment out
// any other method calls.

try {
    /* This portion showcases the Send Message API call. */
    // Enter address to send message to
    $addr = array('ENTER VALUE!');
    // Send a test message
    $response = $immnSrvc->sendMessage($addr, 'Text', 'Subject');
    echo "msgId: " . $response . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get Message List API call. */
    // Enter message list limit
    $limit = 'ENTER VALUE!';
    // Enter offset
    $offset = 'ENTER VALUE!';
    // Send API request to get message list
    $msgList = $immnSrvc->getMessageList($limit, $offset);
    echo "total: " . $msgList->getTotal() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get Message API call. */
    // Enter message id
    $msgId = 'ENTER VALUE!';
    // Send API request to get message
    $msg = $immnSrvc->getMessage($msgId);
    echo "msgId: " . $msg->getMessageId() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get Message Content API call. */
    // Enter message id
    $msgId = 'ENTER VALUE!';
    // Enter part id
    $partId = 'ENTER VALUE!';
    // Send API request for getting message content
    $msgContent = $immnSrvc->getMessageContent($msgId, $partId);
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get Messages Delta API call. */
    // Enter message state
    $state = 'ENTER VALUE!';
    // Send API request for getting delta of messages
    $msgsDelta = $immnSrvc->getMessagesDelta($state);
    echo "state: " . $msgsDelta->getState() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Update Messages API call. */
    // Enter message id to update
    $msgId = 'ENTER VALUE';
    // Update the message favorite status to true
    $favorite = true;
    // Update the unread status to true
    $unread = true;
    // Create an array that contains an IMMNDeltaChange object to pass to the
    // IMMNService object
    $immnDeltaChange = array(new IMMNDeltaChange($msgId, $favorite, $unread));
    // Send API request for updating messages
    $immnSrvc->updateMessages($immnDeltaChange);
    echo "Successfully updated messages.\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Update Message API call. */
    $msgId = 'ENTER VALUE';
    // Update the message favorite status to true
    $favorite = true;
    // Update the unread status to true
    $unread = true;
    // Send API request for updating message
    $immnSrvc->updateMessage($msgId, $unread, $favorite);
    echo "Successfully updated message.\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Delete Messages API call. */
    // Enter message ids to delete
    $msgIds = array('ENTER VALUE!');
    // Send API request for deleting the specified messages
    $immnSrvc->deleteMessages($msgIds);
    echo "Successfully deleted messages.\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Create Message Index API call. */
    // Send API request for creating message index
    $immnSrvc->createMessageIndex();
    echo "Successfully created message index.\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get Message Index Info API call. */
    // Send API request for getting message index info
    $msgIndexInfo = $immnSrvc->getMessageIndexInfo();
    echo 'state: ' . $msgIndexInfo->getState() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

try {
    /* This portion showcases the Get Notification Connection Details API call. */
    // Enter queues value
    $queues = 'ENTER VALUE!';
    // Send API request for getting notification connection details
    $details = $immnSrvc->getNotificationConnectionDetails($queues);
    echo 'username: ' . $details->getUsername(). "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse();
}

?>
