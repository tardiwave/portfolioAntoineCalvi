<?php
http_response_code(404);
$router->template = "templateMain";
$pageTitle = "Erreur 404";
$pageDescription = "Vous vous êtes perdu en chemin, cette page n'existe pas.";
?>
<h1 class="notFoundTitle">Page non trouvée</h1>
<h2 class="notFoundSubTitle">Erreur 404</h2>
<a class="notFoundButton" href="<?= $router->url('home') ?>">Retourner à l'accueil</a>