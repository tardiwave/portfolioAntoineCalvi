<?php
$router->template = "templateAdmin";
$pageTitle = "News - Admin";
$pageDescription = "Éditer les news du site.";

use App\Connection;
use App\Table\NewsTable;
use App\HTML\Form;
use App\Validators\NewsValidator;
use App\ObjectHelper;
use App\Auth;

Auth::checkAuthorization($router);
$pdo = Connection::getPDO();
$newsTable = new NewsTable($pdo);
$news = $newsTable->find(1);
$success = false;

$errors = [];
$fields = ['title', 'content'];

if(!empty($_POST)){
    $v = new NewsValidator($_POST, $newsTable, $news->getId());
    ObjectHelper::hydrate($news, $_POST, $fields);
    if($v->validate()){
        $newsTable->update([
            'title' => $news->getTitle(),
            'content' => $news->getContent(),
        ], $news->getId());
        $success = true;
    }else{
        $errors = $v->errors();
    }
}
$form = new Form($news, $errors);
if($success){
    echo "<div class='alert alert-success' role='alert'>Les news ont bien été modifiées</div>";
}
if(!empty($errors)){
    echo "<div class='alert alert-danger' role='alert'>Les news n'ont pas pu être modifiées</div>";
}
?>

<h1>Éditer profil</h1>

<?php 
$button = 'Mettre à jour les news';
require('_form.php');
?>
