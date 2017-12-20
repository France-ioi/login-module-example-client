<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
function run($action) {
    global $config;
    $client = new FranceIOI\LoginModuleClient\Client($config['login_module']);
    $manager = $client->getAccountsManager();
    try {
        switch($action) {
            case 'create':
                $res = $manager->create($_POST['prefix'], $_POST['amount'], isset($_POST['auto_login']));
                break;
            case 'delete':
                $res = $manager->delete($_POST['prefix']);
                break;
            default:
                $res = 'Bad action';
        }
    } catch(Exception $e) {
        $res = $e->getMessage();
    }

    echo '<pre>'.var_export($res, true).'</pre>';
}

$prefix = isset($_POST['prefix']) ? $_POST['prefix'] : 'test';
$amount = isset($_POST['amount']) ? $_POST['amount'] : '1';
$auto_login = isset($_POST['auto_login']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Login module accounts manager client</title>
        <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="demo_app.js"></script>
    </head>
    <body>
        <h3>Create accounts</h3>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input type="hidden" name="action" value="create"/>
            <div>
                Prefix <input type="text" name="prefix" value="<?=$prefix?>"/>
            </div>
            <div>
                Amount <input type="text" name="amount" value="<?=$amount?>"/>
            </div>
            <div>
                <label>
                    <input type="checkbox" name="auto_login" <?=($auto_login ? 'checked="checked"' : '')?>/>
                    Create auto login token
                </label>
            </div>
            <input type="submit"/>
        </form>

        <h3>Delete accounts</h3>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input type="hidden" name="action" value="delete"/>
            <div>
                Prefix <input type="text" name="prefix" value="<?=$prefix?>"/>
            </div>
            <input type="submit"/>
        </form>

        <hr/>

        <?php
            if(isset($_POST['action'])) {
                run($_POST['action']);
            }
        ?>
        <pre></pre>
    </body>
</html>