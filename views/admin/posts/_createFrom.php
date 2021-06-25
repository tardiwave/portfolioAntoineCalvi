<form action="" method="POST" enctype="multipart/form-data">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->input('slug', 'Slug') ?>
    <?= $form->select('categories_ids', 'Catégorie', $categories) ?>
    <?= $form->input('date', 'Date') ?>
    <button type="submit" class="btn btn-primary mb-3"><?= $button ?></button>
</form>