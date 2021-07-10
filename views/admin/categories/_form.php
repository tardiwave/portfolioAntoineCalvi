<form action="" method="POST">
    <?= $form->input('name', 'Titre', true) ?>
    <?= $form->input('slug', 'Slug', true) ?>
    <?= $form->input('date', 'Date', true) ?>
    <button type="submit" class="btn btn-primary mb-3"><?= $button ?></button>
</form>