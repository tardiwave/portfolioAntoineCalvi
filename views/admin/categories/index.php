<?php
$router->layout = "layoutAdmin";
$pageTitle = "Catégories - Admin";
$pageDescription = "Gérez les catégories du blog";

use App\Connection;
use App\Table\CategoryTable;
use App\Auth;

Auth::checkAuthorization($router);
$pdo = Connection::getPDO();
$link = $router->url('adminCategories');
[$categories, $queryPagination] = (new CategoryTable($pdo))->findPaginated();

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
    <a href="<?= $router->url('adminCreateCategory');  ?>">
        Ajouter catégorie
    </a>
</div>



<h1>Administration catégories</h1>

<table>
    <thead>
        <th>Id</th>
        <th>Titre</th>
        <th>Date</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach($categories as $category): ?>
        <tr>
            <td>
                #<?= e($category->getId()) ?>
            </td>
            <td>
                <a href="<?= $router->url('category', ['slug' => e($category->getSlug()), 'id' => e($category->getId())]);  ?>">
                    <?= e($category->getName()) ?>
                </a>
            </td>
            <td>
                <a href="<?= $router->url('category', ['slug' => e($category->getSlug()), 'id' => e($category->getId())]);  ?>">
                    <?= e($category->getDate()->format('d/m/Y')) ?>
                </a>
            </td>
            <td>
                <a href="<?= $router->url('adminEditCategory', ['id' => e($category->getId())]);  ?>">
                    Éditer
                </a>
                <form method="POST" action="<?= $router->url('adminDeleteCategory', ['id' => e($category->getId())]); ?>" style="display: inline;"
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