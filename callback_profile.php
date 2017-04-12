<?php

session_start();

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';

try {
    $client = new FranceIOI\LoginModuleClient\Client($config['login_module']);
    $authorization_helper = $client->getAuthorizationHelper();
    $user = $authorization_helper->queryUser();
    $_SESSION['user'] = $user;
    $result = array(
        'user' => $user
    );
} catch(Exception $e) {
    $result = [
        'error' => 'client_error',
        'error_description' => $e->getMessage()
    ];
}
?>

<!DOCTYPE html>
<html>
<body>
    <script type="text/javascript">
        if(window.opener && window.opener['__LoginModuleCallbackProfile']) {
            window.opener.__LoginModuleCallbackProfile(<?=json_encode($result)?>);
        }
        window.close();
    </script>
</body>
</html>