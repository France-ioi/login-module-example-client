<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';

$provider = new \League\OAuth2\Client\Provider\GenericProvider($config);
$authorization_url = $provider->getAuthorizationUrl();
header('Location: ' .$authorization_url);