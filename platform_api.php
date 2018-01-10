<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
function run($action) {
    global $config;
    $client = new FranceIOI\LoginModuleClient\Client($config['login_module']);

    try {
        switch($action) {
            case 'create':
                $res = $client->getAccountsManager()->create([
                    'prefix' => $_POST['prefix'],
                    'amount' => $_POST['amount'],
                    'auto_login' => isset($_POST['auto_login']),
                    'participation_code' => isset($_POST['participation_code'])
                ]);
                break;
            case 'delete':
                $res = $client->getAccountsManager()->delete([
                    'prefix' => $_POST['prefix']
                ]);
                break;
            case 'reset_do_not_posess':
                $res = $client->getBadgesManager()->resetDoNotPossess([
                    'user_id' => $_POST['user_id'],
                    'code' => $_POST['code']
                ]);
                break;
            default:
                $res = 'Bad action';
        }
    } catch(Exception $e) {
        $res = $e->getMessage();
    }

    echo '<pre>'.var_export($res, true).'</pre>';
}

$prefix = isset($_POST['prefix']) ? $_POST['prefix'] : 'test_';
$amount = isset($_POST['amount']) ? $_POST['amount'] : '1';
$auto_login = isset($_POST['auto_login']);
$participation_code = isset($_POST['participation_code']);
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$code = isset($_POST['code']) ? $_POST['code'] : '';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Login module accounts manager client</title>
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
            <div>
                <label>
                    <input type="checkbox" name="participation_code" <?=($participation_code ? 'checked="checked"' : '')?>/>
                    Create participation code
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

        <h3>Reset do_not_posess</h3>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input type="hidden" name="action" value="reset_do_not_posess"/>
            <div>
                User ID <input type="text" name="user_id" value="<?=$user_id?>"/>
            </div>
            <div>
                Badge code <input type="text" name="code" value="<?=$code?>"/>
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