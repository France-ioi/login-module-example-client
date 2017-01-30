<?php

$login_module_host =  'http://login-module.dev';

$config = [
    'clientId' => '2TtBe7ZRvX1kL1scrsJvMHSGfQhRKXskD7RIOvY1',
    'clientSecret' => 'WxdQFS9gkNfDnTdNMtB3hHI6AstmiI82fKyRftSV',
    'redirectUri' => 'http://login-module-example-client.dev/oauth_callback.php',
    'urlAuthorize' => $login_module_host,
    'urlAccessToken' => $login_module_host.'/oauth_server/access_token',
    'urlResourceOwnerDetails' => $login_module_host.'/oauth_server/user_profile'
];