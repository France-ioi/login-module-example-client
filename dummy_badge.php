<?php

    /*
        script imitates:
        https://badges.concours-alkindi.fr/qualification_tour2/2017
    */


    function codeValid($code) {
        return $code && $code < 100;
    }


    function outputJSON($data) {
        header('Content-Type: application/json');
        die(json_encode($data));
    }


    function generateUser($code) {
        return [
            'sLogin' => 'badge_login'.$code,
            'sEmail' => 'email'.$code.'@test.test',
            'sFirstName' => 'badge_first_name'.$code,
            'sLastName' => 'badge_last_name'.$code,
            'sStudentId' => $code,
            'sSex' => 'm'
        ];
    }


    function getParam($name) {
        if(!empty($_POST[$name])) {
            return $_POST[$name];
        }
        outputJSON([
            'success' => false,
            'error' => $name.' param is required'
        ]);
    }



    $action = getParam('action');
    $code = (int) getParam('code');

    switch($action) {
        case 'verifyCode':
            if(codeValid($code)) {
                outputJSON([
                    'success' => true,
                    'userInfos' => generateUser($code)
                ]);
            }
            die('null'); // lol
            break;

        case 'removeByCode':
            if(codeValid($code)) {
                outputJSON([
                    'success' => true
                ]);
            }
            outputJSON([
                'success' => false,
                'error' => 'code is not valid'
            ]);
            break;

        case 'updateInfos':
            $user_id = getParam('idUser');
            if(codeValid($code)) {
                outputJSON([
                    'success' => true
                ]);
            } else {
                outputJSON([
                    'success' => false,
                    'error' => 'code is not valid'
                ]);
            }
            break;

        default:
            outputJSON([
                'success' => false,
                'error' => $action.' is not a valid action'
            ]);
            break;
    }