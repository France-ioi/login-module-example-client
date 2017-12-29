<?php

    /*
        script imitates:
        https://badges.concours-alkindi.fr/qualification_tour2/2017
    */



    function logMsg($msg) {
        file_put_contents(
            __DIR__.'/logs/badge.log',
            '['.date('Y-m-d H:i:s').'] '.$msg.PHP_EOL,
            FILE_APPEND | LOCK_EX
        );
    }


    function outputJSON($data) {
        logMsg('RESPONSE: '.print_r($data, true));
        header('Content-Type: application/json');
        die(json_encode($data));
    }


    function outputNull() {
        logMsg('RESPONSE: null');
        die('null'); // lol
    }


    function codeValid($code) {
        return $code && $code < 100;
    }


    function generateUser($code) {
        return [
            //'sLogin' => 'badge_login'.$code,
            //'sEmail' => 'email'.$code.'@test.test',
            'sFirstName' => 'Dmitriy', //'badge_first_name'.$code,
            'sLastName' => 'Zubkov', //'badge_last_name'.$code,
            'sStudentId' => $code,
            'sSex' => 'm',
            'data' => [
                'category' => 'badge_category'.$code
            ]
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


    logMsg('REQUEST: '.print_r($_POST, true));
    $action = getParam('action');
    $code = (int) getParam('code');

    switch($action) {
        case 'verifyCode':
            if(codeValid($code)) {
                outputJSON(
                    generateUser($code)
                );
            }
            outputNULL();
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