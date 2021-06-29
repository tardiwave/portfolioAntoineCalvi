<p><?= $post->getName(); ?></p>
<p><?= $post->getDate()->format('d/m/Y'); ?></p>
<a href="<?= $router->url('post', ['slug' => $post->getSlug(), 'id' => $post->getId()]); ?>">Voir l'article</a>
<p>Categories :<p>
<?php
foreach($post->getCategories() as $key=>$category):
    if($key > 0 && $key != 0):
        echo ', ';
    endif;
    $categoryUrl = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
    ?><a href="<?= $categoryUrl ?>"><?= e($category->getName()) ?></a><?php
endforeach; ?>