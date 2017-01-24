<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';

$provider = new \League\OAuth2\Client\Provider\GenericProvider($config);

try {
    $accessToken = $provider->getAccessToken('authorization_code', [ 'code' => $_GET['code'] ]);

    echo $accessToken->getToken() . "\n";
    echo $accessToken->getRefreshToken() . "\n";
    echo $accessToken->getExpires() . "\n";
    echo ($accessToken->hasExpired() ? 'expired' : 'not expired') . "\n";

    $resourceOwner = $provider->getResourceOwner($accessToken);
    var_export($resourceOwner->toArray());
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    exit($e->getMessage());
}