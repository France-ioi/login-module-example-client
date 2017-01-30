<?php
    require_once __DIR__.'/config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>IOI Auth popup login</title>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
        <script type="text/javascript" src="bower_components/jschannel/src/jschannel.js"></script>
        <script type="text/javascript" src="ioi_auth_helper.js"></script>
    </head>
    <body>
        <a href="/oauth_redirect.php">Login redirect</a>
        <a id="login" href="#">Login popup</a>

        <pre id="js-result"></pre>
        <div id="php-result"></div>

        <script type="text/javascript">
            var backend_url = '<?=$config['redirectUri']?>';
            var auth = new IOIAuthHelper({
                url: '<?=$config['urlAuthorize']?>',
                client_id: '<?=$config['clientId']?>',
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
    </body>
</html>