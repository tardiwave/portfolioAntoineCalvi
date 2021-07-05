<?php

    use App\Connection;
    use App\Models\{Post, Category};
    use App\Table\PostTable;
    use App\Table\CategoryTable;

    $id = (int)$params['id'];
    $slug = e($params['slug']);

    $pdo = Connection::getPDO();

    $postTable = new PostTable($pdo);
    $post = $postTable->find($id);
    $postNumber = (new CategoryTable($pdo))->hydratePost([$post]);

    if ($post === null){
        echo 'mauvais id';
    }else {
        $realSlug = $post->getSlug();
        if ($realSlug != $slug){
            echo 'mauvais slug';
            $url = $router->url('post',['slug' => $realSlug, 'id' => $id]);
            http_response_code(301);
            header('Location: ' . $url);
        }else {
            $router->template = "templateMain";
            $pageTitle = $post->getName();
            $pageDescription = $post->getSDesc();
        }
    }
?>
<h1>Article <?= $post->getName() ?></h1>

<a href="<?= $router->url('adminEditPost', ['id' => $post->getId()]) ?>">Modifier</a>

<p><?= $post->getContent() ?></p>

<?php foreach($post->getImageArr() as $image): ?>
    <img src="/uploads/posts/large_<?= $image ?>" alt="" style="width: 1200px;">
<?php endforeach; ?>


<h2>Categories :</h2>
<?php if($postNumber < 1):?>
    <p>Le post ne contient pas de catégories.</p>
<?php endif; ?>
<?php foreach($post->getCategories() as $category): ?>
    <a href="<?= $router->url('category', ['slug' => $category->getSlug(), 'id' => $category->getId()]) ?>"><?= $category->getName(); ?></a>
<?php endforeach; ?>