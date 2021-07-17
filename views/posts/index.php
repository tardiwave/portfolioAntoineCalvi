<?php
$router->template = "templateMain";
$pageTitle = "Posts";
$pageDescription = "L'ensemble des posts";

use App\Connection;
use App\URL;
use App\Table\PostTable;

?>
<h1>Posts</h1>
<?php
$pdo = Connection::getPDO();

URL::removeParamOne('page');
$currentPage = URL::getPositiveInt('page', 1);

$table = new PostTable($pdo);
[$posts, $queryPagination] = $table->findPaginated();

$table = new PostTable($pdo);
$table->findPaginated();

$link = $router->url('posts');

?>
<div class="pageTitleContainer">
    <h1 class="pageTitle">Tous mes travaux</h1>
    <span class="pageTitleLine"></span>
</div>
<div class="postsGrid">
    <?php if(count($posts) >= 1): ?>
        <?php 
            foreach($posts as $post):
            require '../src/components/Card.php';
            endforeach;
        ?>
    <?php else: ?>
        <h2 class="noElements">Pas de posts à afficher</h2>
    <?php endif; ?>
</div>
<?= $queryPagination->getPagination($link) ?>