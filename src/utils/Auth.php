<?php
namespace App;

class Auth {

    public static function check() : bool
    {
        if(session_status() === PHP_SESSION_NONE || session_status() === 1){
            session_start();
        }
        if(!isset($_SESSION['auth'])) {
            return false;
        }
        return true;
    }

    public static function checkAuthorization ($router)
    {
        if(!Auth::check()) {
            http_response_code(403);
            header('Location: ' . $router->url('login') . '?forbidden=true');
            exit();
        }else{
            // echo 'connecté';
        }
    }
}