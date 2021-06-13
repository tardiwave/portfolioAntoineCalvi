<?php
use App\Auth;
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $pageTitle . ' - ' . $appName ?></title>
        <meta name="description" content="<?= $pageDescription ?? "" ?>">
    </head>
    <h1>Public Mode</h1>
    <nav>
        <ul>
            <li><a href="<?= $router->url('home') ?>">Home</a></li>
            <li><a href="<?= $router->url('posts') ?>">Posts</a></li>
            <li><a href="<?= $router->url('categories') ?>">Categories</a></li>
            <?php  if(Auth::check()): ?>
                <li><a href="<?= $router->url('admin') ?>">Administration</a></li>
                <form action="<?= $router->url('logout') ?>" method="POST">
                    <button type="submit">Se déconnecter</button>
                </form>
            <?php else: ?>
                <li><a href="<?= $router->url('login') ?>">Se connecter</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <body>
        <?= $pageContent ?>
        <?= $pageJavascripts ?? '' ?>
    </body>
</html>