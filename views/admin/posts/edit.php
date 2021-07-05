<?php
$router->template = "templateAdmin";
$pageTitle = "Éditer post - Admin";
$pageDescription = "Éditer un post de votre blog.";

use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\PostValidator;
use App\Attachment\PostAttachment;
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
$noImage = false;
$fields = ['name', 'content', 'slug', 'date'];
if(!empty($_POST)){
    $data = array_merge($_POST);
    $v = new PostValidator($data, $postTable, $post->getId(), $categories);
    ObjectHelper::hydrate($post, $data, $fields);
    if($v->validate()){
        $pdo->beginTransaction();
            PostAttachment::add($post);
            $postTable->updatePost([
                'name' => $post->getName(),
                'slug' => $post->getSlug(),
                'content' => $post->getContent(),
                'createdAt' => $post->getDate()->format('Y-m-d H:i:s'),
                'image' => $post->getImageStr(),
                'imageExtension' => $post->getImageExtension()
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
if ( isset($_GET['deleteimage']) && $_GET['deleteimage']==='success'){
    echo "Suppression de l'image réussie";
}elseif($success && !$noImage){
    echo "L'article à bien été actualisé";
}

if(!empty($errors)){
    echo "L'article n'a pas pu être modifié";
}
?>

<div class="inline mb-5 justify-content-between">
<h1>Éditer post <?= e($post->getName()) ?></h1>
<a href="<?= $router->url('post', ['slug' => $post->getSlug(), 'id' => $post->getId()]); ?>"class="btn btn-primary">Visioner Article</a>
</div>

<?php 
$button = 'Modifier Post';
require('_form.php');
?>
