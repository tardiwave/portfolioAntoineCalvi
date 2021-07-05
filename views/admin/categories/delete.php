<?php
$router->template = "templateAdmin";
$pageTitle = "Supprimer catégorie - Admin";
$pageDescription = "Supprimer une catégorie de votre blog.";

use App\Connection;
use App\Table\CategoryTable;
use App\Auth;

Auth::checkAuthorization($router);

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$table->delete($params['id']);
http_response_code(301);
header('Location: ' . $router->url('adminCategories') . '?delete=success');

?>

<h1>Supprimer catégorie <?= $params['id'] ?></h1>