<form action="<?= $router->url('adminEditPost', ['id' => e($post->getId())]) ?>" method="POST" enctype="multipart/form-data">
    <div class="" data-bs-toggle="collapse" href="#mainInfos" role="button" aria-expanded="false" aria-controls="mainInfos">
        <div class="d-flex justify-content-between">
            <h2>Informations principales</h2>
            <img src="/assets/icons/arrow-down.svg" alt="" class="" style="width: 20px;">
        </div>
        <hr>
    </div>
    <div class="collapse" id="mainInfos">
        <?= $form->input('name', 'Titre', true) ?>
        <?= $form->input('slug', 'Slug', true) ?>
        <?= $form->textarea('sDesc', 'Petite description', true) ?>
        <?= $form->select('categories_ids', 'Catégorie', $categories) ?>
        <?= $form->input('date', 'Date', true) ?>
        <?php
        $thumbnail = $post->getThumbnail();
        var_dump($thumbnail);
        if($thumbnail):
        ?>
        <img src="/uploads/posts/thumbnail_<?= $thumbnail ?>" class="thumbnailPost" alt="">
        <?php endif; ?>
        <div class="inline">
            <?= $form->file('thumbnail', 'Illustration (max 2Mo)') ?>
            <button
                type="submit"
                class="btn btn-primary mb-3"
                style="
                    height: fit-content;
                    white-space: nowrap;
                    margin-top: auto;
                    margin-left: 1em;"
            >Mettre à jour/ Ajouter la miniature</button>
        </div>
        <button type="submit" class="btn btn-primary mb-3"><?= $button ?></button>
        <div class="inline">
        </div>
    </div>
    <div class="" data-bs-toggle="collapse" href="#contenu" role="button" aria-expanded="<?= ($_GET['orderimage'] === 'success') ? 'true' : 'false'; ?>" aria-controls="contenu">
        <div class="d-flex justify-content-between">
            <h2>Contenu</h2>
            <img src="/assets/icons/arrow-down.svg" alt="" class="" style="width: 20px;">
        </div>
        <hr>
    </div>
    <div class="collapse <?php if($_GET['orderimage'] === 'success') echo'show'; ?>" id="contenu">
        <h3>Ajouter image</h3>
        <div class="inline">
            <?= $form->file('image', 'Illustration (max 2Mo)') ?>
            <button
                type="submit"
                class="btn btn-primary mb-3"
                style="
                    height: fit-content;
                    white-space: nowrap;
                    margin-top: auto;
                    margin-left: 1em;"
            >Ajouter image</button>
        </div>
</form>
<?php 
    $imagesTab = $post->getImageArr();
    foreach($imagesTab as $key => $image): ?>
    <?php
        $linkImage = str_replace(".","-",$image);
        $linkImage = explode("-",$linkImage);
        $upType = 'submit';
        $up = null;
        if($key === 0){
            $upType = 'button';
            $up = 'disabled';
        }else{
            $upType = 'submit';
            $up = null;
        }
        if($key === (count($imagesTab)-1)){
            $downType = 'button';
            $down = 'disabled';
        }else{
            $downType = 'submit';
            $down = null;
        }
    ?>
<div class="imagePostContainer">
    <div>
        <img src="/uploads/posts/large_<?= $image ?>" class="imagePost" alt="">
    </div>
    <div class="orderButtons">
        <form method="POST" action="<?= $router->url('adminOrderPostImage', ['id' => e($post->getId()), 'image1' => $linkImage[0], 'image2' => $linkImage[1], 'ext' => $linkImage[2], 'action' => 'up']); ?>" style="display: inline;">
                <button type="<?= $upType ?>" class="page-link m-1 <?= $up ?>" style="border-radius: .25rem;">
                    <img src="/assets/icons/arrow-up.svg" class="imgChangeOrder" alt="">
                </button>
        </form>
        <form method="POST" action="<?= $router->url('adminOrderPostImage', ['id' => e($post->getId()), 'image1' => $linkImage[0], 'image2' => $linkImage[1], 'ext' => $linkImage[2], 'action' => 'down']); ?>" style="display: inline;">
                <button type="<?= $downType ?>" class="page-link m-1 btnChangeOrder <?= $down ?>" style="border-radius: .25rem;">
                    <img src="/assets/icons/arrow-down.svg" class="imgChangeOrder" alt="">
                </button>
        </form>
        <form method="POST" action="<?= $router->url('adminDeletePostImage', ['id' => e($post->getId()), 'image1' => $linkImage[0], 'image2' => $linkImage[1], 'ext' => $linkImage[2]]); ?>" style="display: inline;"
                onSubmit="return confirm('Voulez-vous vraiment supprimer cette image?')">
                <button type="submit" class="btn btn-danger m-1">
                X
                </button>
        </form>
    </div>
</div>
<?php endforeach;?>
</div>