<?php

namespace App;

class URL {

    public static function getInt(string $name, ?int $default = null): ?int
    {
        if(!isset($_GET[$name])) return $default;
        
        if($_GET[$name] === '0') return 0;

        if(!filter_var($_GET[$name], FILTER_VALIDATE_INT)) {
            echo "Le paramètre $name n'est pas un entier.";
            $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
            $get = $_GET;
            $round = round($get[$name]);
            $get[$name] = $round;
            $query = http_build_query($get);
            echo $get;
            if (!empty($query)){
                $uri = $uri . '?' . $query;
            }
            http_response_code(301);
            header('Location: ' . $uri);
            exit();
            return $default;
        }

        return (int)$_GET[$name];
    }

    public static function getPositiveInt(string $name, ?int $default = null): ?int
    {
        $param = self::getInt($name, $default);
        if(!isset($_GET[$name])) return $default;
        if($param !== null && $param <= 0){
            echo "Le paramètre $name n'est pas un entier positif.";
            return $default;
        }
        return (int)$_GET[$name];
    }
    public static function removeEmptyParam(string $name): void
    {
        if(isset($_GET[$name]) && $_GET[$name] == null){
            $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
            $get = $_GET;
            unset($get[$name]);
            $query = http_build_query($get);
            if (!empty($query)){
                $uri = $uri . '?' . $query;
            }
            http_response_code(301);
            header('Location: ' . $uri);
            exit();
        }
    }
    public static function removeParamOne(string $name): void
    {
        if(isset($_GET[$name]) && $_GET[$name] === '1'){
            $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
            $get = $_GET;
            unset($get[$name]);
            $query = http_build_query($get);
            if (!empty($query)){
                $uri = $uri . '?' . $query;
            }
            http_response_code(301);
            header('Location: ' . $uri);
            exit();
        }
    }
}