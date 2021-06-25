<?php
$router->layout = "layoutAdmin";
$pageTitle = "Supprimer post - Admin";
$pageDescription = "Supprimer un post de votre blog.";

use App\Connection;
use App\Table\PostTable;
use App\Auth;
use App\Attachment\PostAttachment;

Auth::checkAuthorization($router);

$pdo = Connection::getPDO();
$table = new PostTable($pdo);
$post = $table->find($params['id']);
PostAttachment::detach($post);
$table->delete($params['id']);
http_response_code(301);
header('Location: ' . $router->url('adminPosts') . '?delete=success');

?>

<h1>Supprimer post <?= $params['id'] ?></h1>