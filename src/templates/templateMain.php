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