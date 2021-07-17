<form action="" method="POST">
    <?= $form->input('firstname', 'Prénom', true) ?>
    <?= $form->input('lastname', 'Nom', true) ?>
    <?= $form->input('birth', 'Date de naissance', true) ?>
    <?= $form->input('mail', 'Adresse mail', true) ?>
    <?= $form->input('work', 'Travail', true) ?>
    <?= $form->checkbox('status', 'Disponible?', true) ?>
    <?= $form->textarea('description', 'Description', true) ?>
    <?= $form->input('instagram', 'Lien du compte Instagram', false) ?>
    <?= $form->input('behance', 'Lien du compte Behance', false) ?>
    <button type="submit" class="btn btn-primary mb-3"><?= $button ?></button>
</form>