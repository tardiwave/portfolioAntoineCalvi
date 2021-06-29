<?php
namespace App;
use \PDO;

class Connection{
    public static function getPDO (): PDO {
        // $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '0000');
        $pdo = new PDO('mysql:dbname=blog;host=localhost', 'root', '0000');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}