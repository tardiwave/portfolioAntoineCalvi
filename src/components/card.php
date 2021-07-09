<div class="postCard">
    <div class="postCardThumbnail">
        <a href="<?= $router->url('post', ['slug' => $post->getSlug(), 'id' => $post->getId()]); ?>">
            <?php
                $postName = $post->getName();
                $postDesc = $post->getSDesc();
                $thumbnail = $post->getThumbnail();
                if($thumbnail):
            ?>
                <img src="/uploads/posts/thumbnail_<?= $thumbnail ?>" class="" alt="<?= $postName; ?>">
            <?php endif; ?>
            <span class="borders">
                <span class="c">
                    <span class="square"></span>
                    <span class="square"></span>
                    <span class="square"></span>
                </span>
                <span class="c">
                    <span class="square"></span>
                    <span class="square"></span>
                </span>
                <span class="c">
                    <span class="square"></span>
                    <span class="square"></span>
                    <span class="square"></span>
                </span>
            </span>
            <span class="border"></span>
        </a>
    </div>
    <a href="<?= $router->url('post', ['slug' => $post->getSlug(), 'id' => $post->getId()]); ?>" class="title"><?= $postName; ?></a>
    <a href="<?= $router->url('post', ['slug' => $post->getSlug(), 'id' => $post->getId()]); ?>" class="desc"><?= $postDesc; ?></a>
    <div class="postCardCategories">
        <?php
            foreach($post->getCategories() as $key=>$category):
            $categoryUrl = $router->url('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);
        ?>
            <a href="<?= $categoryUrl ?>" class="postCardCategory"><?= e($category->getName()) ?></a>
        <?php endforeach;?>
    </div>
</div>