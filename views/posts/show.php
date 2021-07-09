<?php

    use App\Connection;
    use App\Models\{Post, Category};
    use App\Table\PostTable;
    use App\Table\CategoryTable;
    use App\Auth;

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
<div class="pageTitleContainer">
    <h1 class="pageTitle"><?= $post->getName() ?></h1>
    <span class="pageTitleLine"></span>
    <p class="postDesc"><?= $post->getSDesc() ?></p>
    <div class="postCategories">
        <?php if($postNumber < 1):?>
            <p>Le post ne contient pas de catégories.</p>
        <?php endif; ?>
        <?php foreach($post->getCategories() as $category): ?>
            <a class="postCategory" href="<?= $router->url('category', ['slug' => $category->getSlug(), 'id' => $category->getId()]) ?>"><?= $category->getName(); ?></a>
        <?php endforeach; ?>
    </div>
    <?php  if(Auth::check()): ?>
        <a class="postEdit" href="<?= $router->url('adminEditPost', ['id' => $post->getId()]) ?>">Modifier</a>
    <?php endif; ?>
</div>

<p><?= $post->getContent() ?></p>

<?php foreach($post->getImageArr() as $image): ?>
    <img src="/uploads/posts/large_<?= $image ?>" class="postImage" alt="">
<?php endforeach; ?>