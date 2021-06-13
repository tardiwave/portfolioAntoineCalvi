<?php
$router->layout = "layoutAdmin";
$pageTitle = "Créer catégorie - Admin";
$pageDescription = "Ajouter une catégorie à votre blog.";

use App\Connection;
use App\Table\CategoryTable;
use App\HTML\Form;
use App\Validators\CategoryValidator;
use App\ObjectHelper;
use App\Models\Category;
use App\Auth;

Auth::checkAuthorization($router);

$success = false;

$errors = [];
$fields = ['name', 'slug', 'date'];
$category = new Category();
$category->setDate(date('Y-m-d H:i:s'));

if(!empty($_POST)){
    $pdo = Connection::getPDO();
    $categoryTable = new CategoryTable($pdo);
    $v = new CategoryValidator($_POST, $categoryTable, $category->getId());
    ObjectHelper::hydrate($category, $_POST, $fields);
    if($v->validate()){
        $categoryTable->create([
            'name' => $category->getName(),
            'slug' => $category->getSlug(),
            'createdAt' => $category->getDate()->format('Y-m-d H:i:s')
        ]);
        http_response_code(301);
        header('Location: ' . $router->url('adminCategories') . '?create=success');
        exit();
    }else{
        $errors = $v->errors();
    }
}
$form = new Form($category, $errors);
if($success){
    echo "La catégorie à bien été créée.";
}
if(!empty($errors)){
    echo "La catégorie n'a pas pu être créée.";
}
?>

<h1>Créer une catégorie</h1>


<?php 
$button = 'Créer catégorie';
require('_form.php');
?>