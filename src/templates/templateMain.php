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
        <link rel="stylesheet" href="/styles/main.css">
    </head>
    <?php require($layoutPath . 'Header.php'); ?>
    <body>
        <div class="pageContainer">
            <?= $pageContent ?>
        </div>
    </body>
    <?php require($layoutPath . 'Footer.php'); ?>
    <?= $pageJavascripts ?? '' ?>
    <script src="/scripts/scriptMain.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6VEFGYJVDG"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-6VEFGYJVDG');
    </script>
</html>