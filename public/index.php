<?php
    require '../vendor/autoload.php';

    use App\Auth;
    use App\Router;
    require '../config/app.php';

    $auth = new Auth();
    $router = new Router($viewPath . '/views', $appName);
    require '../config/routes.php';
    $router->run();
    
?>