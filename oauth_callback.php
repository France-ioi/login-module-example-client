<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';

$provider = new \League\OAuth2\Client\Provider\GenericProvider($config);

echo '<pre>';
try {
    $accessToken = $provider->getAccessToken('authorization_code', [ 'code' => $_GET['code'] ]);

    echo 'Access token: '.$accessToken->getToken(). "\n";
    echo 'Token expires: '.$accessToken->getExpires() . "\n";
    echo 'Token: '.($accessToken->hasExpired() ? 'expired' : 'not expired') . "\n";

    $resourceOwner = $provider->getResourceOwner($accessToken);
    echo "Resource owner data:\n";
    var_export($resourceOwner->toArray());
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    echo($e->getMessage());
}
echo '</pre>';