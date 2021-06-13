<form action="" method="POST">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->textarea('slug', 'Slug') ?>
    <?= $form->textarea('content', 'Contenu') ?>
    <?= $form->select('categories_ids', 'Catégorie', $categories) ?>
    <?= $form->input('date', 'Date') ?>
    <button type="submit"><?= $button ?></button>
</form>