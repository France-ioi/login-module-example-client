<?php

session_start();
session_destroy();

$result = [
    'success' => true
];
?>
<!DOCTYPE html>
<html>
<body>
    <script type="text/javascript">
        if(window.opener && window.opener['__LoginModuleCallbackLogout']) {
            window.opener.__LoginModuleCallbackLogout(<?=json_encode($result)?>);
        } else {
            window.close();
        }
    </script>
</body>
</html>