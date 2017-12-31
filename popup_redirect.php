<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';

try {
    $client = new FranceIOI\LoginModuleClient\Client($config['login_module']);
    $redirect_helper = $client->getRedirectHelper();
} catch(Exception $e) {
    die($e->getMessage());
}

$base_url = (isset($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'];
$action = isset($_GET['action']) ? $_GET['action'] : die('Empty action');
switch($action) {
    case 'login':
        $authorization_helper = $client->getAuthorizationHelper();
        $url = $authorization_helper->getUrl(['locale' => 'en']);
        break;
    case 'logout':
        $url = $redirect_helper->getLogoutUrl($base_url.'/callback_logout.php');
        break;
    case 'profile':
        $url = $redirect_helper->getProfileUrl($base_url.'/callback_profile.php');
        break;
    case 'account':
        $url = $redirect_helper->getAccountUrl($base_url.'/callback_profile.php');
        break;
    case 'badge':
        $url = $redirect_helper->getBadgeUrl($base_url.'/callback_profile.php');
        break;
    case 'password':
        $url = $redirect_helper->getPasswordUrl($base_url.'/callback_empty.php');
        break;
    case 'auth_methods':
        $url = $redirect_helper->getAuthMethodsUrl($base_url.'/callback_empty.php');
        break;
    default:
        die('Invalid action');
}
header('Location: '.$url);