<?php

require_once 'vendor/autoload.php';

$google_client = new Google_Client();
$google_client->setClientId('21397960040-aeq4a8e5b86csq7jn1qk5rfac3e2n0ke.apps.googleusercontent.com');
$google_client->setClientSecret('4ghs4XdseFKOuI8Poa_dOX3_');
$google_client->setRedirectUri('http://localhost/new%20code/loginwithgoogle/index.php');
$google_client->addScope('email');
$google_client->addScope('profile');

session_start();
?>