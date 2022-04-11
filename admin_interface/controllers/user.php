<?php
class User {

    public function login() {
        $this->redirectBack();
    }    

    public function logout() {
        session_destroy();
        $this->redirectBack();
    }    

    public function refresh() {
        $this->redirectBack();
    }        

    public function delete() {
        $this->redirectBack();
    }


    private function getUserId() {
        if(isset($_GET['user_id'])) {
            return (int) $_GET['user_id'];
        }
        die('Error: user_id param missed');
    }

    private function redirectBack() {
        $url = isset($_GET['redirect_url']) ? $_GET['redirect_url'] : null;
        if(isset($_GET['redirect_url'])) {
            header('Location: '.$_GET['redirect_url']);
            die();
        }
        die('Action completed.');
    }
}