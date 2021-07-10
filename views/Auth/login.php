<?php
$router->template = "templateMain";
$pageTitle = "Login";
$pageDescription = "Connectez vous au blog";

use App\Connection;
use App\Models\User;
use App\HTML\Form;
use App\Table\UserTable;

$user = new User();

$errors = [];
if(!empty($_POST)){
    $errors['password'] = 'Identifiant ou mot de passe incorrect.';
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
<div class="loginForm">
    <h1 class="loginTitle">Se connecter</h1>
    <form action="<?= $router->url('login') ?>" method="post">
        <div>
            <label for="fieldusername" class="loginLabel">Nom d'utilisateur <span title="required">*</span></label>
            <input name="username" type="text" class="loginInput" placeholder="Nom d'utilisateur" required>
        </div>
        <div>
            <label for="fieldusername" class="loginLabel">Mot de passe<span title="required">*</span></label>
            <input name="password" type="password" class="loginInput" placeholder="Mot de passe" required>
        </div>
        <p class="loginError"><?= $errors['password'] ?></p>
        <button class="loginButton" type="submit">Se connecter</button>
    </form>
</div>