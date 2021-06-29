<?php
namespace App;

class User {

    public $id;

    public $username;

    public $mail;

    public $password;

    public $firstname;

    public $lastname;

    public $description;

    public $role;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function user()
    {
        
    }

    public function login(string $username, string $password)
    {

    }


}