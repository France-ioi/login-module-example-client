<?php
    if(isset($_GET['error'])) {
        $result = array(
            'error' => $_GET['error'],
            'error_description' => $_GET['error_description']
        );
    } else {
        $result = array(
            'success' => true
        );
    }
?>
<!DOCTYPE html>
<html>
<body>
    <script type="text/javascript">
        if(window.opener && window.opener['__IOIAuthHelper']) {
            window.opener.__IOIAuthHelper.logoutCallback(<?=json_encode($result)?>);
        } else {
            window.close();
        }
    </script>
</body>
</html>