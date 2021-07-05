<?php
$router->template = "templateAdmin";
$pageTitle = "Créer post - Admin";
$pageDescription = "Ajouter un post à votre blog.";

use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\PostValidator;
use App\Attachment\PostAttachment;
use App\ObjectHelper;
use App\Models\Post;
use App\Auth;

Auth::checkAuthorization($router);
$success = false;
$pdo = Connection::getPDO();
$errors = [];
$fields = ['name', 'slug', 'date'];
$post = new Post();
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post->setDate(date('Y-m-d H:i:s'));

if(!empty($_POST)){

    $postTable = new PostTable($pdo);
    $data = array_merge($_POST, $_FILES);
    $v = new PostValidator($data, $postTable, $post->getId(), $categories);
    ObjectHelper::hydrate($post, $data, $fields);
    if($v->validate()){
        $pdo->beginTransaction();
            $id = $postTable->create([
                'name' => $post->getName(),
                'slug' => $post->getSlug(),
                'createdAt' => $post->getDate()->format('Y-m-d H:i:s'),
            ]);
            if(isset($_POST["categories_ids"])){
                $postTable->attachCategories($id, $_POST["categories_ids"]);
            }
        $pdo->commit();;
        http_response_code(301);
        header('Location: ' . $router->url('adminPosts') . '?create=success');
        exit();
    }else{
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);
if($success){
    echo "L'article à bien été créé.";
}
if(!empty($errors)){
    echo "L'article n'a pas pu être créé.";
}
?>

<h1>Créer un post</h1>


<?php 
$button = 'Créer Post';
require('_createFrom.php');
?>