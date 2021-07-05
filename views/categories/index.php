<?php
$router->template = "templateMain";
$pageTitle = "Categories";
$pageDescription = "L'ensemble des cayegories";
use App\Helpers\Text;
use App\Models\Category;
use App\Connection;
use App\URL;
use App\QueryPagination;
?>
<h1>Categories</h1>
<?php
$pdo = Connection::getPDO();

URL::removeParamOne('page');
$currentPage = URL::getPositiveInt('page', 1);

$queryPagination = new QueryPagination(
    "SELECT * FROM categories ORDER BY createdAt DESC",
    "SELECT COUNT(id) FROM categories"
);
$categories = $queryPagination->getItems(Category::class, []);
$link = $router->url('categories');

?>
<?php foreach($categories as $category): ?>
    <p><?= $category->getName(); ?></p>
    <p><?= $category->getDate()->format('d/m/Y'); ?></p>
    <a href="<?= $router->url('category', ['slug' => $category->getSlug(), 'id' => $category->getId()]); ?>">Voir la categorie</a>
<?php endforeach; ?>

<h2>Pagination</h2>
<?= $queryPagination->previousLink($link) ?>
<?= $queryPagination->nextLink($link) ?>