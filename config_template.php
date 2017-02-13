<?php

$client_host = 'http://login-module-example-client.dev';
$login_module_host =  'http://login-module.dev';

$config = [
    'oauth' => [
        'clientId' => '3',
        'clientSecret' => 'l5B9AWOtpCr4sVHkctF1erU2eiPypYG7K4fi9mEq',
        'urlAuthorize' => $login_module_host.'/oauth/authorize',
        'urlAccessToken' => $login_module_host.'/oauth/token',
        'urlResourceOwnerDetails' => $login_module_host.'/api/account',
        'redirectUri' => $client_host.'/callback_oauth.php'
    ],
    'logout' => [
        'url' => $login_module_host.'/logout',
        'redirectUri' => $client_host.'/callback_logout.php'
    ],
    'account' => [
        'url' => $login_module_host.'/account',
        'redirectUri' => $client_host.'/callback_account.php'
    ],

];