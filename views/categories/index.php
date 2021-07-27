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


<div class="pageTitleContainer">
    <h1 class="pageTitle">Toutes les categories</h1>
    <span class="pageTitleLine"></span>
</div>
<div class="postsGrid">
    <?php if(count($categories) >= 1): ?>
        <?php foreach($categories as $category): ?>
            <div class="categoryCard">
                <div>
                    <h2 class="categoryCardTitle"><?= $category->getName(); ?></h2>
                    <p class="categoryCardDesc"><?= $category->getSDesc() ?></p>
                </div>
                <a class="categoryCardLink" href="<?= $router->url('category', ['slug' => $category->getSlug(), 'id' => $category->getId()]); ?>">Voir plus</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h2 class="noElements">Pas de catégories à afficher</h2>
    <?php endif; ?>
</div>
<?= $queryPagination->getPagination($link) ?>