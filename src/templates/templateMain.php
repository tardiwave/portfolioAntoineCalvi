<?php
    use App\Auth;
    use App\Connection;
    use App\Table\SettingsTable;
    $pdo = Connection::getPDO();
    $settingsTable = new SettingsTable($pdo);
    $settings = $settingsTable->find(1);
    $googleAnalyticsKey = $settings->getGoogleAnalyticsKey();

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $pageTitle . ' - ' . $appName ?></title>
        <meta name="description" content="<?= $pageDescription ?? "" ?>">
        <link rel="stylesheet" href="/styles/main.css">

        <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="./assets/favicon/site.webmanifest">
        <link rel="mask-icon" href="./assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#000000">
        <meta name="theme-color" content="#000000">

        <meta property="og:title" content="Antoine Calvi" />
        <meta property="og:description" content="Portfolio Antoine Calvi" />
        <meta property="og:image" content="[image URL, see below]" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />

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
    <?php if($googleAnalyticsKey): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $googleAnalyticsKey ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?= $googleAnalyticsKey ?>');
        </script>
    <?php endif; ?>
</html>