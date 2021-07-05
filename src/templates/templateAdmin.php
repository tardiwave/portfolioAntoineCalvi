<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $pageTitle . ' - ' . $appName ?></title>
        <meta name="description" content="<?= $pageDescription ?? "" ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <style>
            <?php include("../src/styles/admin.css") ; ?>
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar navbar-light bg-light mobileNavBar fixed-top">
            <div class="container-fluid px-md-5">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="<?= $router->url('home') ?>">Logo</a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= $router->url('home') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $router->url('adminPosts') ?>">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $router->url('adminCategories') ?>">Categories</a>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong class="color: black;">Antoine Calvi</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <!-- <li><a class="dropdown-item" href="#">Profile</a></li> -->
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="<?= $router->url('logout') ?>" method="POST">
                                    <button type="submit" class="dropdown-item">Se déconnecter</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="d-flex bodyContainer">
            <div class="d-flex flex-column flex-shrink-0 p-3 desktopNavBar bg-light" style="width: 280px;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto  text-decoration-none">
                    <span class="m-2" >LOGO</span>
                    <span class="fs-4">Portfolio</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="<?= $router->url('home') ?>" class="nav-link" aria-current="page">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                        Home
                        </a>
                    </li>
                    <li>
                        <a href="<?= $router->url('adminPosts') ?>" class="nav-link <?php if(explode("/",e($_SERVER['REQUEST_URI']))[2] === 'posts') echo 'active' ?>">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Posts
                        </a>
                    </li>
                    <li>
                        <a href="<?= $router->url('adminCategories') ?>" class="nav-link <?php if(explode("/",e($_SERVER['REQUEST_URI']))[2] === 'categories') echo 'active' ?>">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                        Catégories
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center  text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>Antoine Calvi</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Profile</a></li> -->
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= $router->url('logout') ?>">Se déconnecter</a></li>
                    </ul>
                </div>
            </div>
            <div class="canScroll">
                <div class="container pageContent">
                    <?= $pageContent ?>
                </div>
            </div>
        </div>
    </body>
    <?= $pageJavascripts ?? '' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</html>