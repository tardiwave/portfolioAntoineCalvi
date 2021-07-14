<?php
http_response_code(403);
$router->template = "templateMain";
$pageTitle = "Erreur 403";
$pageDescription = "Vous vous n'êtes pas autorisés à accéder à cette page.";
?>
<h1 class="notFoundTitle">Vous vous n'êtes pas autorisés à accéder à cette page</h1>
<h2 class="notFoundSubTitle">Erreur 403</h2>
<a class="notFoundButton" href="<?= $router->url('home') ?>">Retourner à l'accueil</a>