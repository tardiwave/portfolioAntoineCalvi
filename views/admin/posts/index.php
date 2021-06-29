<?php
$router->layout = "layoutAdmin";
$pageTitle = "Posts - Admin";
$pageDescription = "Gérez les posts du blog";

use App\Connection;
use App\Table\PostTable;
use App\Auth;
Auth::checkAuthorization($router);
$pdo = Connection::getPDO();
$link = $router->url('adminPosts');
[$posts, $queryPagination] = (new PostTable($pdo))->findPaginated();

?>

<?php
    if ( isset($_GET['delete']) && $_GET['delete']==='success'){
        echo 'Suppression réussie';
    }
?>

<?php
    if ( isset($_GET['create']) && $_GET['create']==='success'){
        echo 'Création réussie';
    }
?>



<div class="d-flex flex-wrap justify-content-between align-items-center">
    <h1>Administration posts</h1>
    <a href="<?= $router->url('adminCreatePost');  ?>" class="btn btn-primary my-1" style="height: fit-content;">
        Ajouter post
    </a>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Titre</th>
            <th scope="col">Date</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($posts as $post): ?>
            <tr>
                <td>
                    #<?= e($post->getId()) ?>
                </td>
                <td>
                    <a href="<?= $router->url('post', ['slug' => e($post->getSlug()), 'id' => e($post->getId())]);  ?>">
                        <?= e($post->getName()) ?>
                    </a>
                </td>
                <td>
                    <a href="<?= $router->url('post', ['slug' => e($post->getSlug()), 'id' => e($post->getId())]);  ?>">
                        <?= e($post->getDate()->format('d/m/Y')) ?>
                    </a>
                </td>
                <td class="d-flex flex-wrap justify-content-center">
                    <a href="<?= $router->url('adminEditPost', ['id' => e($post->getId())]);  ?>" class="btn btn-primary m-1">
                        Éditer
                    </a>
                    <form method="POST" action="<?= $router->url('adminDeletePost', ['id' => e($post->getId())]); ?>" style="display: inline;"
                        onSubmit="return confirm('Voulez-vous vraiment effectuer cette action?')">
                        <button type="submit" class="btn btn-danger m-1">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-center">
    <?= $queryPagination->getPagination($link) ?>
</div>