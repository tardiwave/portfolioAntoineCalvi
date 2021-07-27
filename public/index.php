<?php
    require '../vendor/autoload.php';

    use App\Auth;
    use App\Router;
    require '../config/app.php';

    //error_reporting(0);

    define('UPLOAD_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'uploads');

    $auth = new Auth();
    $router = new Router($viewPath . '/views', $appName, $componentsPath, $layoutPath, $templatesPath);
    require '../config/routes.php';
    $router->run();
    
?>