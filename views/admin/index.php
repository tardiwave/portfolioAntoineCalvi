<?php
$router->template = "templateAdmin";
$pageTitle = "Dashboard - Admin";
$pageDescription = "Gérez l'ensemble du blog";

use App\Auth;

Auth::checkAuthorization($router);
?>
<h1>Dashboard</h1>

<div class="row row-cols-1 row-cols-lg-3 g-4">
  <div class="col">
    <div class="card h-100 ">
        <div class="card-body">
            <h5 class="card-title">Gérer les posts</h5>
            <p class="card-text">Publiez, éditez vos posts...</p>
            <a href="<?= $router->url('adminPosts') ?>" class="btn btn-primary">Gérer</a>
        </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100 ">
        <div class="card-body">
            <h5 class="card-title">Gérer les catégories</h5>
            <p class="card-text">Publiez, éditez vos catégories de posts...</p>
            <a href="<?= $router->url('adminCategories') ?>" class="btn btn-primary">Gérer</a>
        </div>
    </div>
  </div>
</div> 