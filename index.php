<?php
    require_once __DIR__.'/config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>IOI Auth popup login</title>
        <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="bower_components/jschannel/src/jschannel.js"></script>
        <script type="text/javascript" src="ioi_auth_helper.js"></script>
    </head>
    <body>
        <h3>OAuth tests</h3>
        <a id="login" href="#">Login</a>
        <a id="logout" href="#">Logout</a>
        <a id="account" href="#">Account</a>
        <pre id="result"></pre>

        <script type="text/javascript">
            function showResult(message, data) {
                $('#result').html(message + (data ? '\n' + JSON.stringify(data, null, '\t') : ''));
            }
            var config = <?=json_encode($config)?>;
            var auth = new IOIAuthHelper({
                oauth: {
                    url: config.oauth.urlAuthorize,
                    client_id: config.oauth.clientId,
                    redirect_uri: config.oauth.redirectUri,
                    onSuccess: function(res) {
                        showResult('Authorization success', res);
                    },
                    onError: function(res) {
                        showResult('Authorization error', res);
                    },
                },
                logout: {
                    url: config.logout.url,
                    redirect_uri: config.logout.redirectUri,
                    onSuccess: function(res) {
                        showResult('Logout success', res);
                    },
                    onError: function(res) {
                        showResult('Logout error', res);
                    },
                },
                account: {
                    url: config.account.url,
                    redirect_uri: config.account.redirectUri,
                    onSuccess: function(res) {
                        showResult('Account success', res);
                    },
                    onError: function(res) {
                        showResult('Account error', res);
                    },
                }
            })

            $('#login').click(function() {
                auth.oauth(Math.random().toString());
            })
            $('#logout').click(function() {
                auth.logout();
            })
            $('#account').click(function() {
                auth.account();
            })
        </script>

<!--
        <h3>LTI test</h3>
        <form action="<?=$config['lti']['url']?>" method="GET">
            RedirectURL <input type="text" name="redirectUrl" value="<?='http://'.$_SERVER['HTTP_HOST'].'/lti_callback.php'?>"/>
            Token <input type="text" name="token" value=""/>
            Platform <input type="text" name="platform" value=""/>
            <button type="submit">Login</button>
        </form>
-->
    </body>
</html>