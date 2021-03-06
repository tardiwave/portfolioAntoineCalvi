<?php

    use App\Connection;
    use App\Models\{Post, Category};
    use App\Table\CategoryTable;
    use App\QueryPagination;
    use App\URL;
    use App\Auth;

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
            $router->template = "templateMain";
            $pageTitle = $category->getName();
            $pageDescription = $category->getSDesc();

            URL::removeParamOne('page');
            $currentPage = URL::getPositiveInt('page', 1);

            [$posts, $queryPagination] = $categoryTable->findPaginatedPost($category);
            $link = $router->url('category',['slug' => $slug, 'id'=> $id]);
        }
    }
?>


<div class="pageTitleContainer">
    <h1 class="pageTitle">Categorie <?= $category->getName() ?></h1>
    <span class="pageTitleLine"></span>
    <?php  if(Auth::check()): ?>
        <a class="postEdit" href="<?= $router->url('adminEditCategory', ['id' => $category->getId()]) ?>">Modifier</a>
    <?php endif; ?>
</div>
<div class="postsGrid">
    <?php 
        foreach($posts as $post):
        require '../src/components/Card.php';
        endforeach;
    ?>
</div>
<?= $queryPagination->getPagination($link) ?>