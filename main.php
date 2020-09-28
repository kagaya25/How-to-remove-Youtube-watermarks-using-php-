<?php

require_once __DIR__ . '/vendor/autoload.php';
$client = new Google_Client();
$client->setScopes([
    'https://www.googleapis.com/auth/youtube.force-ssl',
]);

$credentialsFile = './client_secret.json'; # put your outh2.0 here name it  client_secret.json
$client->setAuthConfig($credentialsFile);
$client->setAccessType('offline');

// Request authorization from the user.
$authUrl = $client->createAuthUrl();
printf("Open this link in your browser:\n%s\n", $authUrl);
print('Enter verification code: ');
$authCode = trim(fgets(STDIN));

// Exchange authorization code for an access token.
$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
$client->setAccessToken($accessToken);

// Define service object for making API requests.
$service = new Google_Service_YouTube($client);
try{
# https://github.com/googleapis/google-api-php-client/issues/1955
# dont use unset methods use unsetWatermarks
$service->watermarks->unsetWatermarks('UCiBfuUreTbKvBKtQbb6SIWQ'); # this your youtube channel id 
}catch(Exception $e){
	echo ($e->getMessage());
}







