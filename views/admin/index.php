<?php
$router->layout = "layoutAdmin";
$pageTitle = "Dashboard - Admin";
$pageDescription = "Gérez l'ensemble du blog";

error_reporting(0);

use App\Auth;

Auth::checkAuthorization($router);
?>
<h1>Dashboard</h1>

<a href="<?= $router->url('home') ?>">Accueil</a>
<a href="<?= $router->url('adminPosts') ?>">Gérer les posts</a>
<a href="<?= $router->url('adminCategories') ?>">Gérer les catégories</a>
