<?php
$router->template = "templateAdmin";
$pageTitle = "Paramètres - Admin";
$pageDescription = "Éditer les paramètres du site.";

use App\Connection;
use App\Table\SettingsTable;
use App\HTML\Form;
use App\Validators\SettingsValidator;
use App\ObjectHelper;
use App\Auth;

Auth::checkAuthorization($router);
$pdo = Connection::getPDO();
$settingsTable = new SettingsTable($pdo);
$settings = $settingsTable->find(1);
$success = false;

$errors = [];
$fields = ['perPage', 'imageGap'];

if(!empty($_POST)){
    $v = new SettingsValidator($_POST, $settingsTable, $settings->getId());
    ObjectHelper::hydrate($settings, $_POST, $fields);
    if($v->validate()){
        $settingsTable->update([
            'perPage' => $settings->getPerPage(),
            'imageGap' => $settings->getImageGap(),
        ], $settings->getId());
        $success = true;
    }else{
        $errors = $v->errors();
    }
}
$form = new Form($settings, $errors);
if($success){
    echo "<div class='alert alert-success' role='alert'>Les settings ont bien été modifiées</div>";
}
if(!empty($errors)){
    echo "<div class='alert alert-danger' role='alert'>Les settings n'ont pas pu être modifiées</div>";
}
?>

<h1>Éditer profil</h1>

<?php 
$button = 'Mettre à jour les paramètres';
require('_form.php');
?>
