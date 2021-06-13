<?php

namespace App\Table;

use App\QueryPagination;

use App\Models\Category;

use App\Models\Post;

use \PDO;

final class CategoryTable extends Table{

    protected $table = 'categories';

    protected $class = Category::class;

    public function getPosts (Category $category)
    {
        $query = $this->pdo->prepare("
        SELECT p.id, p.slug, p.name
        FROM posts_categories pc
        JOIN posts p ON pc.postId = p.id
        WHERE pc.postId = :id");
        $query->execute(['id' => $category->getId()]);
        $query->setFetchMode(PDO::FETCH_CLASS, Category::class);
        return $query->fetchAll();
    }

    public function findPaginated()
    {
        $queryPagination = new QueryPagination(
            "SELECT * FROM categories ORDER BY createdAt DESC",
            "SELECT COUNT(id) FROM categories",
            $this->pdo
        );
        $categories = $queryPagination->getItems(Category::class, []);
        return [$categories, $queryPagination];
        
    }

    public function findPaginatedPost(Category $category)
    {
        $queryPagination = new QueryPagination(
            "SELECT *
            FROM posts_categories pc
            JOIN posts p ON pc.postId = p.id
            WHERE pc.categoryId = :id",
            "SELECT COUNT(postId) FROM posts_categories",
            $this->pdo
        );
        $posts = $queryPagination->getItems(Post::class, ['id', $category->getId()]);
        (new CategoryTable($this->pdo))->hydratePost($posts);
        return [$posts, $queryPagination];
    }

    public function hydratePost(array $posts):int
    {
        if(empty($posts)){ 
            return 0;
        }else
        {
            $postsById = [];
            foreach($posts as $post) {
                $post->setCategories([]);
                $postsById[$post->getId()] = $post;
            }
            $categories = $this->pdo
                ->query('SELECT c.id, c.slug, c.name, pc.postId
                FROM posts_categories pc
                JOIN categories c ON pc.categoryId = c.id
                WHERE pc.postId IN (' . implode(', ', array_keys($postsById)) . ')'
                )->fetchAll(PDO::FETCH_CLASS, Category::class);
            foreach($categories as $category){
                $postsById[$category->getPostId()]->addCategory($category);
            }
            return count($categories);
        }
    }

    public function list (): array
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY name ASC";
        $categories = $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
        $result = [];
        foreach($categories as $category){
            $result[$category->getId()] = $category->getName();
        }
        return $result;
    }

}