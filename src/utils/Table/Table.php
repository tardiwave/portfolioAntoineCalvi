<?php

namespace App\Table;

use App\QueryPagination;

use App\Models\Post;

use App\Models\Category;

use \PDO;

abstract class Table{

    protected $pdo;

    protected $table = null;

    protected $class = null;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function find (int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        return $query->fetch() ?: null;
    }

    public function exist (string $field, $value, ?int $exception = null): bool
    {
        $sql = "SELECT COUNT(id) FROM {$this->table} WHERE {$field} = ?";
        $params = [$value];
        if($exception != null){
            $sql .= " AND id != ?";
            $params[] = $exception;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        $query->setFetchMode(PDO::FETCH_NUM);
        return (int)$query->fetch()[0] > 0;
    }

    public function create (array $data): int
    {
        $sqlFields = [];
        foreach($data as $key => $value){
            $secureKey = e($key);
            $sqlFields[] = "$secureKey = :$secureKey";
        }
        $query = $this->pdo->prepare("INSERT INTO {$this->table} SET " . implode(', ', $sqlFields));
        $ok = $query->execute($data);
        if($ok === false){
            echo "Impossible de créer le post.";
        }
        return (int)$this->pdo->lastInsertId();
    }

    public function all (): array
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY createAt DESC";
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }

    public function update (array $data, int $id)
    {
        $sqlFields = [];
        foreach($data as $key => $value){
            $secureKey = e($key);
            $sqlFields[] = "$secureKey = :$secureKey";
        }
        $query = $this->pdo->prepare("UPDATE {$this->table} SET " . implode(', ', $sqlFields) . " WHERE id = :id");
        $ok = $query->execute(array_merge($data, ['id' => $id]));
        if($ok === false){
            echo "Impossible de mettre à jour {$id} de la table {$this->table}.";
        }
    }

    public function delete (int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $ok = $query->execute(['id' => $id]);
        if($ok === false){
            echo "Impossible de supprimer {$id} dans la table {$this->table}.";
        }
    }
}