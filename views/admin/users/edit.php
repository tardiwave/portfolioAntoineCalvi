<?php
$router->template = "templateAdmin";
$pageTitle = "Profil - Admin";
$pageDescription = "Éditer les informations de votre user.";

use App\Connection;
use App\Table\UserTable;
use App\HTML\Form;
use App\Validators\UserValidator;
use App\ObjectHelper;
use App\Auth;

Auth::checkAuthorization($router);
$pdo = Connection::getPDO();
$userTable = new UserTable($pdo);
$user = $userTable->findByUsername('admin');
$success = false;

$errors = [];
$fields = ['firstname', 'lastname', 'mail', 'birth', 'work', 'status', 'description', 'instagram', 'behance'];

if(!empty($_POST)){
    $v = new UserValidator($_POST, $userTable, $user->getId());
    ObjectHelper::hydrate($user, $_POST, $fields);
    if($v->validate()){
        $userTable->update([
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'mail' => $user->getMail(),
            'birth' => $user->getBirth()->format('Y-m-d H:i:s'),
            'work' => $user->getWork(),
            'status' => true,
            'description' => $user->getDescription(),
            'instagram' => $user->getInstagram(),
            'behance' => $user->getBehance(),
        ], $user->getId());
        $success = true;
    }else{
        $errors = $v->errors();
    }
}
$form = new Form($user, $errors);
if($success){
    echo "<div class='alert alert-success' role='alert'>Le profil à bien été modifié</div>";
}
if(!empty($errors)){
    echo "<div class='alert alert-danger' role='alert'>Le profil n'a pas pu être modifié</div>";
}
?>

<h1>Éditer profil</h1>

<?php 
$button = 'Modifier profil';
require('_form.php');
?>
