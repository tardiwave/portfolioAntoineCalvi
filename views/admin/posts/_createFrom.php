<form action="" method="POST" enctype="multipart/form-data">
    <?= $form->input('name', 'Titre', true) ?>
    <?= $form->input('slug', 'Slug', true) ?>
    <?= $form->select('categories_ids', 'Catégorie', $categories) ?>
    <?= $form->input('date', 'Date', true) ?>
    <button type="submit" class="btn btn-primary mb-3"><?= $button ?></button>
</form>