<?php

    use App\Connection;
    use App\Models\{Post, Category};
    use App\Table\CategoryTable;
    use App\QueryPagination;
    use App\URL;

    $id = (int)$params['id'];
    $slug = e($params['slug']);

    $pdo = Connection::getPDO();

    $categoryTable = new CategoryTable($pdo);
    $category = $categoryTable->find($id);

    if ($category === null){
        echo 'mauvais id';
    }else{
        $realSlug = $category->getSlug();
        if ($realSlug != $slug){
            echo 'mauvais slug';
            $url = $router->url('category',['slug' => $realSlug, 'id' => $id]);
            http_response_code(301);
            header('Location: ' . $url);
        }else {
            $pageTitle = $category->getName();
            $pageDescription = $category->getSDesc();

            URL::removeParamOne('page');
            $currentPage = URL::getPositiveInt('page', 1);

            [$posts, $queryPagination] = $categoryTable->findPaginatedPost($category);
            $link = $router->url('category',['slug' => $slug, 'id'=> $id]);
        }
    }
?>
<h1>Categorie <?= $category->getName() ?></h1>

<a href="<?= $router->url('adminEditCategory', ['id' => $category->getId()]) ?>">Modifier</a>

<?php foreach($posts as $post):
    require '../src/components/card.php';
endforeach; 
?>
<?php if(count($posts) < 1):?>
    <p>La catégorie ne contient pas de posts.</p>
<?php else: ?>
<h2>Pagination</h2>
<?php endif; ?>
<?= $queryPagination->previousLink($link) ?>
<?= $queryPagination->nextLink($link) ?>