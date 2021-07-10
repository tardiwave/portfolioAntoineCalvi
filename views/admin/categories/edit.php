<?php
$router->template = "templateAdmin";
$pageTitle = "Éditer categorie - Admin";
$pageDescription = "Éditer une categorie de votre blog.";

use App\Connection;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\CategoryValidator;
use App\ObjectHelper;
use App\Auth;

Auth::checkAuthorization($router);
$pdo = Connection::getPDO();
$categoryTable = new CategoryTable($pdo);
$category = $categoryTable->find($params['id']);
$success = false;

$errors = [];
$fields = ['name', 'slug', 'date'];

if(!empty($_POST)){
    $v = new CategoryValidator($_POST, $categoryTable, $category->getId());
    ObjectHelper::hydrate($category, $_POST, $fields);
    if($v->validate()){
        $categoryTable->update([
            'name' => $category->getName(),
            'slug' => $category->getSlug(),
            'createdAt' => $category->getDate()->format('Y-m-d H:i:s')
        ], $category->getId());
        $success = true;
    }else{
        $errors = $v->errors();
    }
}
$form = new Form($category, $errors);
if($success){
    echo "<div class='alert alert-success' role='alert'>La catégorie à bien été modifiée</div>";
}
if(!empty($errors)){
    echo "<div class='alert alert-danger' role='alert'>La catégorie n'a pas pu être modifiée</div>";
}
?>

<h1>Éditer categorie <?= e($category->getName()) ?></h1>

<?php 
$button = 'Modifier catégorie';
require('_form.php');
?>
