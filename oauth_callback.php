<?php

    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'/config.php';

    if(isset($_GET['code'])) {
        $provider = new \League\OAuth2\Client\Provider\GenericProvider($config['oauth']);
        try {
            $token = $provider->getAccessToken('authorization_code', [ 'code' => $_GET['code'] ]);
            $result = array(
                'user' => $provider->getResourceOwner($token)->toArray()
            );
        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            $result = array(
                'error' => 'client_error',
                'error_description' => $e->getMessage()
            );
        }
    } else {
        $result = array(
            'error' => $_GET['error'],
            'error_description' => $_GET['error_description']
        );
    }
?>
<!DOCTYPE html>
<html>
<body>
    <script type="text/javascript">
        if(window.opener && window.opener['__IOIAuthHelper']) {
            window.opener.__IOIAuthHelper.popupCallback(<?=json_encode($result)?>);
        } else {
            window.close();
        }
    </script>
</body>
</html>