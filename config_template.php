<?php

$login_module_host =  'http://login-module.dev';

$config = [
    'clientId' => 'S5HAEwTO6zUMmHcCp60gNYypt45cBpIdLvyd2x96',
    'clientSecret' => 'r8RJ9067NCoc3l67zSEa6JT4V7JFcsnVnaIXZwqV',
    'redirectUri' => 'http://login-module-client.dev/oauth_callback.php',
    'urlAuthorize' => $login_module_host.'/authorization',
    'urlAccessToken' => $login_module_host.'/oauth_server/access_token',
    'urlResourceOwnerDetails' => $login_module_host.'/oauth_server/user_profile'
];