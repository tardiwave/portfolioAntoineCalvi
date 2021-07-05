<?php
$router->template = "templateAdmin";
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

<div class="d-flex flex-wrap justify-content-between align-items-center">
    <h1>Administration catégories</h1>
    <a href="<?= $router->url('adminCreateCategory');  ?>" class="btn btn-primary my-1" style="height: fit-content;">
        Ajouter catégorie
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
                <a href="<?= $router->url('adminEditCategory', ['id' => e($category->getId())]);  ?>" class="btn btn-primary m-1">
                    Éditer
                </a>
                <form method="POST" action="<?= $router->url('adminDeleteCategory', ['id' => e($category->getId())]); ?>" style="display: inline;"
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