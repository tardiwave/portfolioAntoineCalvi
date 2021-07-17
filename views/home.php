<?php
    $router->template = "templateMain";
    $pageTitle = "Accueil";
    $pageDescription = "Accueil";

    use App\Table\PostTable;
    use App\Connection;

    $pdo = Connection::getPDO();
    $table = new PostTable($pdo);
    $postsToDisplay = $table->findHomePage();
?>
<h1 class="pageTitle">Mes derniers travaux</h1>
<span class="pageTitleLine"></span>
<p class="homeDesc">Je suis Antoine Calvi, designer graphique indépendant.<br/>Et bienvenue sur mon Portfolio 👋</p>
<?php if(count($postsToDisplay) > 3): ?>
<div class="sliderContainer">
    <div id="splideMain" class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                <?php foreach($postsToDisplay as $post): ?>
                    <li class="splide__slide">
                        <a href="<?= $router->url('post', ['slug' => $post->getSlug(), 'id' => $post->getId()]); ?>">
                            <img src="/uploads/posts/thumbnail_<?= $post->getThumbnail(); ?>" alt="Thumbnail <?= $post->getName(); ?>">
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
                            <span class="title"><?= $post->getName(); ?></span>
                            <span class="desc"><?= $post->getSDesc(); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php elseif((count($posts) >= 1)): ?>
    <div class="postsGridHome">
        <?php 
            foreach($postsToDisplay as $post):
            require '../src/components/Card.php';
            endforeach;
        ?>
    </div>
<?php else: ?>
    <h2 class="noElements">Pas de catégories à afficher</h2>
<?php endif; ?>

<div class="allTips">
    <?php
        $allTips = [
            'Change la couleur principale du site avec le slider',
            'Maintient le clique gauche enfoncé sur la barre des fenêtres pour les déplacer',
            'Mes réseaux sont en haut à gauche si tu ne veux rien manquer ;)'
        ];
        foreach($allTips as $key=>$tips){
            require '../src/components/Tips.php';
        }
    ?>
</div>

<?php ob_start(); ?>
<script src="/scripts/tips.js"></script>
<script src="/scripts/splide.min.js"></script>
<script src="/scripts/scriptHome.js"></script>
<?php $pageJavascripts .= ob_get_clean(); ?>
