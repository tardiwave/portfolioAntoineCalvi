<?php

namespace App\Table;
use App\Models\User;
use \PDO;

final class UserTable extends Table{

    protected $table = 'users';

    protected $class = User::class;

    public function findByUsername(string $username)
    {
        $query = $this->pdo->prepare("SELECT * FROM " . $this->table . " WHERE username = :username");
        $query->execute(['username' => $username]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        return $query->fetch() ?: null;
    }
    
}  