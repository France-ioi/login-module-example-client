<?php

    require_once __DIR__.'/vendor/autoload.php';
    require_once __DIR__.'/config.php';

    session_start();

    if(!isset($_GET['error'])) {
        $provider = new \League\OAuth2\Client\Provider\GenericProvider($config['oauth']);
        try {
            if(!isset($_SESSION['oauth_access_token'])) {
                $result = array(
                    'error' => 'missed_access_token',
                    'error_description' => 'Access token not found in session data'
                );
            } else {
                $access_token = unserialize($_SESSION['oauth_access_token']);
                if($access_token->hasExpired()) {
                    $new_access_token = $provider->getAccessToken('refresh_token', [
                        'refresh_token' => $access_token->getRefreshToken()
                    ]);
                    $_SESSION['oauth_access_token'] = serialize($new_access_token);
                    $access_token = $new_access_token;
                }
                $result = array(
                    'user' => $provider->getResourceOwner($access_token)->toArray()
                );
            }
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
            window.opener.__IOIAuthHelper.accountCallback(<?=json_encode($result)?>);
        } else {
            window.close();
        }
    </script>
</body>
</html>