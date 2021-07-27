<form action="" method="POST">
    <?= $form->input('title', 'News', false) ?>
    <?= $form->textarea('content', 'Contenu', false) ?>
    <?= $form->input('linkText', 'Titre du boutoin lien', false) ?>
    <?= $form->input('link', 'Lien complémentaire', false) ?>
    <button type="submit" class="btn btn-primary mb-3"><?= $button ?></button>
</form>