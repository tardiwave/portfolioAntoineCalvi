<form action="" method="POST">
    <?= $form->input('title', 'News', false) ?>
    <?= $form->textarea('content', 'Contenu', false) ?>
    <button type="submit" class="btn btn-primary mb-3"><?= $button ?></button>
</form>