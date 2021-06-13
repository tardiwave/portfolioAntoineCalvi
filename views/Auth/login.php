<?php
$pageTitle = "Login";
$pageDescription = "Connectez vous au blog";

use App\Connection;
use App\Models\User;
use App\HTML\Form;
use App\Table\UserTable;

$user = new User();

$errors = [];
$errors['password'] = 'Identifiant ou mot de passe incorrect.';
if(!empty($_POST)){
    $user->setUsername($_POST['username']);
    if( (!empty($_POST['username'])) && (!empty($_POST['password'])) ) {
        $pdo = Connection::getPDO();
        $table = new UserTable($pdo);
        $u = $table->findByUsername($_POST['username']);
        if($u != null && password_verify($_POST['password'], $u->getPassword())){
            $errors = [];
            session_start();
            $_SESSION['auth'] = $u->getId();
            http_response_code(301);
            header('Location: ' . $router->url('admin'));
            exit();
        }
    }
}

$form = new Form($user, $errors);

?>

<h1>Se connecter</h1>

<form action="<?= $router->url('login') ?>" method="post">
    <?= $form->input('username', 'Nom d\'utilisateur'); ?>
    <?= $form->input('password', 'Mot de passe'); ?>
    <button type="submit">Se connecter</button>
</form>