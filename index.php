<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Login module example client</title>
        <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="demo_app.js"></script>
    </head>
    <body>
        <h3>OAuth tests</h3>
        <div id="nav">
            <div id="nav_guest">
                <a raction="login" href="#">Login</a>
            </div>
            <div id="nav_user">
                <span id="user_id"></span>
                <a raction="account" href="#">Account</a>
                <a raction="profile" href="#">Profile</a>
                <a raction="password" href="#">Password</a>
                <a raction="auth_methods" href="#">Auth methods</a>
                <a raction="logout" href="#">Logout</a>
            </div>
        </div>
        <pre id="result"></pre>
        <script type="text/javascript">
            var params = {
                user: <?=(isset($_SESSION['user']) ? json_encode($_SESSION['user']) : 'null')?>
            }
            DemoApp.init(params);
        </script>
    </body>
</html>