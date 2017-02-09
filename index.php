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
        <a href="/oauth_redirect.php">Login redirect</a>
        <a id="login" href="#">Login popup</a>

        <pre id="js-result"></pre>
        <div id="php-result"></div>

        <script type="text/javascript">
            var backend_url = '<?=$config['oauth']['redirectUri']?>';
            var auth = new IOIAuthHelper({
                url: '<?=$config['oauth']['urlAuthorize']?>',
                client_id: '<?=$config['oauth']['clientId']?>',
                redirect_uri: backend_url,

                onAuthorize: function(res) {
                    $('#js-result').html(JSON.stringify(res));
                    $.get(backend_url + '?code=' + res.result.code)
                        .done(function(data) {
                            $('#php-result').html(data);
                        })
                        .fail(function(data) {
                            $('#php-result').html(data);
                        })
                },
                onDeny: function(res) {
                    $('#js-result').html(JSON.stringify(res));
                }
            })
            $('#login').click(function() {
                auth.authorize(Math.random().toString());
            })
        </script>


        <h3>LTI test</h3>
        <form action="<?=$config['lti']['url']?>" method="GET">
            RedirectURL <input type="text" name="redirectUrl" value="<?='http://'.$_SERVER['HTTP_HOST'].'/lti_callback.php'?>"/>
            Token <input type="text" name="token" value=""/>
            Platform <input type="text" name="platform" value=""/>
            <button type="submit">Login</button>
        </form>
    </body>
</html>