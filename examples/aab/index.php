<?php
// This Quickstart Guide for the Address Book API requires the PHP code kit,
// which can be found at:
// https://github.com/attdevsupport/codekit-php

// Make sure the index.php file is in the same directory as the 'lib' folder.
require_once __DIR__ . '/lib/OAuth/OAuthTokenService.php';
require_once __DIR__ . '/lib/AAB/AABService.php';

// Use any namespaced classes.
use Att\Api\AAB\AABService;
use Att\Api\AAB\Contact;
use Att\Api\AAB\ContactCommon;
use Att\Api\AAB\Group;
use Att\Api\OAuth\OAuthTokenService;
use Att\Api\Srvc\ServiceException;

// Use the app account settings from developer.att.com for the following values.
// Make sure that the API scope is set to AAB for the Address Book API before 
// retrieving the App Key and App Secret.

// Enter the value from the 'App Key' field obtained at developer.att.com 
// in your app account.
$clientId = 'ENTER VALUE!';

// Enter the value from the 'App Secret' field obtained at developer.att.com 
// in your app account.
$clientSecret = 'ENTER VALUE!';

// Get the OAuth code by opening a browser to the following URL:
// https://api.att.com/oauth/authorize?client_id=CLIENT_ID&scope=SCOPE&redirect_uri=REDIRECT_URI
// replacing CLIENT_ID, SCOPE, and REDIRECT_URI with the values configured at
// developer.att.com. 
// After authenticating, copy the OAuth code from the browser URL.
$oauthCode = "ENTER VALUE!";

// Create the service for requesting an OAuth access token
$osrvc = new OAuthTokenService('https://api.att.com', $clientId, $clientSecret);

// Get the OAuth token using the OAuth code.
$token = $osrvc->getTokenUsingCode(new OAuthCode($oauthCode));

// Create the service for interacting with the Address Book API.
$aabSrvc = new AABService('https://api.att.com', $token);

// The following lines of code can be used to test the method calls for
// the AABService class. To test a specific method, comment out
// the other method.

/* This try/catch block tests the createContact method. */
try {
    $contactCommon = new ContactCommon();
    // Specify the first name of the contact to be created.
    $contactCommon->firstName = 'ENTER VALUE!';
    // Send request for creating contact.
    $response = $aabSrvc->createContact($contactCommon);
    echo "location: $response\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the getContact method. */
try {
    // Specify the contact id to use in getting contact information.
    $contactId = 'ENTER VALUE!';
    // Send request for getting contact.
    $response = $aabSrvc->getContact($contactId);
    echo "creationDate: " . $response->getCreationDate() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the getContacts method. */
try {
    // Send request for getting contacts.
    $response = $aabSrvc->getContacts();
    echo "totalRecords: " . $response->getTotalRecords() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the getContactGroups method. */
try {
    // Specify the contact id to use in getting contact group information.
    $contactId = 'ENTER VALUE!';
    // Send request for getting contact group information.
    $response = $aabSrvc->getContactGroups($contactId);
    echo "totalRecords: " . $response->getTotalRecords() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the updateContact method. */
try {
    // Specify the contact id whose last name should be updated.
    $contactId = 'ENTER VALUE!';
    // Specify the last name.
    $lastName = 'ENTER VALUE!';
    $arr = array(
        'contactId' => $contactId,
        'lastName' => $lastName
    );
    $contact = Contact::fromArray($arr);
    // Send request for updating contact.
    $aabSrvc->updateContact($contact);
    echo 'successfully updated contact';
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the deleteContact method. */
try {
    // Specify the contact id used to delete contact information.
    $contactId = 'ENTER VALUE!';
    // Send request for deleting contact.
    $aabSrvc->deleteContact($contactId);
    echo 'successfully deleted contact';
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the createGroup method. */
try {
    // Specify the group name to create.
    $groupName = 'ENTER VALUE!';
    $groupType = 'USER';
    $group = new Group($groupName, null, $groupType);
    // Send request for creating group.
    $response = $aabSrvc->createGroup($group);
    echo "location: $response\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the getGroups method. */
try {
    // Send request for getting groups.
    $response = $aabSrvc->getGroups();
    echo "totalRecords: " . $response->getTotalRecords() . "\n";
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the deleteGroup method. */
try {
    // Specify the group id used to delete group information.
    $groupId = 'ENTER VALUE!';
    // Send request for deleting group.
    $aabSrvc->deleteGroup($groupId);
    echo 'successfully deleted group';
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the updateGroup method. */
try {
    // Specify the group name to update.
    $groupName = 'ENTER VALUE!';
    // Specify the group id whose group name to update.
    $groupId = 'ENTER VALUE!';
    $group = new Group($groupName, $groupId);
    // Send request for updating group.
    $response = $aabSrvc->updateGroup($group);
    echo 'successfully updated group';
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the addContactsToGroup method. */
try {
    // Specify group id to add contacts to. 
    $groupId = 'ENTER VALUE!';
    // Specify a list of contact ids to add.
    $contactIds = array('ENTER VALUE!');
    // Send request for adding contacts to a group.
    $aabSrvc->addContactsToGroup($groupId, $contactIds);
    echo 'successfully added contacts to group';
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the removeContactsFromGroup method. */
try {
    // Specify group id to remove contacts from. 
    $groupId = 'ENTER VALUE!';
    // Specify a list of contact ids to remove.
    $contactsIds = array('ENTER VALUE!');
    // Send request for adding contacts to a group.
    $aabSrvc->removeContactsFromGroup($groupId, $contactsIds);
    echo 'successfully deleted contacts from group';
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the getGroupContacts method. */
try {
    // Specify the group id to get group contacts for.
    $groupId = 'ENTER VALUE!';
    // Send request for getting group contacts.
    $response = $aabSrvc->getGroupContacts($groupId);
    echo 'contactIds: ' . implode(',', $response);
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the updateMyInfo method. */
try {
    $contactCommon = new ContactCommon();
    // Specify the first name to be updated.
    $contactCommon->firstName = 'ENTER VALUE!';
    // Send request for updating the subscriber's personal contact card.
    $response = $aabSrvc->updateMyInfo($contactCommon);
    echo 'successfully updated my info';
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

/* This try/catch block tests the getMyInfo method. */
try {
    // Send request to get subscriber's personal contact card.
    $response = $aabSrvc->getMyInfo();
    echo 'firstName: ' . $response->getFirstName();
} catch(ServiceException $se) {
    echo $se->getErrorResponse() . "\n";
}

?>
