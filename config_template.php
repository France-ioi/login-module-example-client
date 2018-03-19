<?php

$base_url = (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];

$config = [
    'login_module' => [
        'id' => '1',
        'secret' => '1AtKfSc7KbgIo8GDCI31pA9laP7pFoBqSg3RtVHq',
        'base_url' => 'http://login-module.test',
        'redirect_uri' => $base_url.'/callback_oauth.php',
    ]
];