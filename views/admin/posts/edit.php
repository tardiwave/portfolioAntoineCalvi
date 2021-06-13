<?php
$router->layout = "layoutAdmin";
$pageTitle = "Éditer post - Admin";
$pageDescription = "Éditer un post de votre blog.";

use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\PostValidator;
use App\ObjectHelper;
use App\Auth;

Auth::checkAuthorization($router);

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$categoryTable->hydratePost([$post]);
$success = false;

$errors = [];
$fields = ['name', 'content', 'slug', 'date'];
if(!empty($_POST)){
    $v = new PostValidator($_POST, $postTable, $post->getId(), $categories);
    ObjectHelper::hydrate($post, $_POST, $fields);
    if($v->validate()){
        $pdo->beginTransaction();
            $postTable->updatePost([
                'name' => $post->getName(),
                'slug' => $post->getSlug(),
                'content' => $post->getContent(),
                'createdAt' => $post->getDate()->format('Y-m-d H:i:s')
            ], $post->getId());
            if(isset($_POST["categories_ids"])){
                $postTable->attachCategories($post->getId(), $_POST["categories_ids"]);
            }
        $pdo->commit();;
            $categoryTable->hydratePost([$post]);
        $success = true;
    }else{
        $errors = $v->errors();
    }
}
$form = new Form($post, $errors);
if($success){
    echo "L'article à bien été modifié";
}
if(!empty($errors)){
    echo "L'article n'a pas pu être modifié";
}
?>

<h1>Éditer post <?= e($post->getName()) ?></h1>

<?php 
$button = 'Modifier Post';
require('_form.php');
?>

<a href="<?= $router->url('adminEditPost', ['id' => e($post->getId())]); ?>">reset</a>
