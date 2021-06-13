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
<div>
    <a href="<?= $router->url('adminCreatePost');  ?>">
        Ajouter post
    </a>
</div>



<h1>Administration posts</h1>

<table>
    <thead>
        <th>Id</th>
        <th>Titre</th>
        <th>Date</th>
        <th>Actions</th>
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
            <td>
                <a href="<?= $router->url('adminEditPost', ['id' => e($post->getId())]);  ?>">
                    Éditer
                </a>
                <form method="POST" action="<?= $router->url('adminDeletePost', ['id' => e($post->getId())]); ?>" style="display: inline;"
                    onSubmit="return confirm('Voulez-vous vraiment effectuer cette action?')">
                    <button type="submit">
                        Supprimer
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Pagination</h2>
<?= $queryPagination->previousLink($link) ?>
<?= $queryPagination->nextLink($link) ?>