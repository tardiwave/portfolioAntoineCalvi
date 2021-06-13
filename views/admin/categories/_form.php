<form action="" method="POST">
    <?= $form->input('name', 'Titre') ?>
    <?= $form->textarea('slug', 'Slug') ?>
    <?= $form->input('date', 'Date') ?>
    <button type="submit"><?= $button ?></button>
</form>