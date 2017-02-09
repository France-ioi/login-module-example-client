<?php

$login_module_host =  'http://login-module.dev';

$config = [
    'oauth' => [
        'clientId' => '3',
        'clientSecret' => 'l5B9AWOtpCr4sVHkctF1erU2eiPypYG7K4fi9mEq',
        'redirectUri' => 'http://login-module-example-client.dev/oauth_callback.php',
        'urlAuthorize' => $login_module_host.'/oauth/authorize',
        'urlAccessToken' => $login_module_host.'/oauth/token',
        'urlResourceOwnerDetails' => $login_module_host.'/api/user_profile'
    ]

];