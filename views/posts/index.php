<?php
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
<?php foreach($posts as $post):
    require '../components/card.php';
endforeach; 
?>

<h2>Pagination</h2>
<?= $queryPagination->previousLink($link) ?>
<?= $queryPagination->nextLink($link) ?>