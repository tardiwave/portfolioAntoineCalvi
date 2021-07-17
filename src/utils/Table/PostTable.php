<?php

namespace App\Table;

use App\QueryPagination;

use App\Models\Post;

use App\Models\Category;

use App\Table\CategoryTable;

use \PDO;

final class PostTable extends Table{

    protected $table = 'posts';

    protected $class = Post::class;

    public function findPaginated()
    {
        $queryPagination = new QueryPagination(
            "SELECT * FROM posts ORDER BY createdAt DESC",
            "SELECT COUNT(id) FROM posts",
            $this->pdo
        );
        $posts = $queryPagination->getItems(Post::class, []);
        (new CategoryTable($this->pdo))->hydratePost($posts);
        return [$posts, $queryPagination];
        
    }

    public function attachCategories(int $id, ?array $categories)
    {
        $this->pdo->exec("DELETE FROM posts_categories WHERE postId = " . $id);
        $queryAddCategories = $this->pdo->prepare('INSERT INTO posts_categories set postId = :postId, categoryId = :categoryId');
        foreach($categories as $category){
            $queryAddCategories->execute(['postId'=> $id, 'categoryId' => $category]);
        }
    }

    public function updatePost (array $data, int $id)
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
    public function findHomePage ()
    {
        $query = $this->pdo->prepare("SELECT name, shortDescription, thumbnail FROM posts WHERE homePage = :display");
        $query->execute(['display' => "on"]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        return $query->fetchAll() ?: null;
    }
}