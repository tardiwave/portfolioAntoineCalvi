<form action="" method="POST">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->input('slug', 'Slug') ?>
    <?= $form->input('date', 'Date') ?>
    <button type="submit" class="btn btn-primary mb-3"><?= $button ?></button>
</form>