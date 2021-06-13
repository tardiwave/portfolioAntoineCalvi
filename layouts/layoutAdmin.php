<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $pageTitle . ' - ' . $appName ?></title>
        <meta name="description" content="<?= $pageDescription ?? "" ?>">
        
    </head>
    <h1>Admin Mode</h1>
    <nav>
        <ul>
            <li><a href="<?= $router->url('home') ?>">home</a></li>
            <li><a href="<?= $router->url('adminPosts') ?>">Posts</a></li>
            <li><a href="<?= $router->url('adminCategories') ?>">Categories</a></li>
            <form action="<?= $router->url('logout') ?>" method="POST">
                <button type="submit">Se déconnecter</button>
            </form>
        </ul>
    </nav>
    <body>
        <?= $pageContent ?>
        <?= $pageJavascripts ?? '' ?>
    </body>
</html>