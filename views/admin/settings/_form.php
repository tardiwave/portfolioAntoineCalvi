<form action="" method="POST">
    <?= $form->input('perPage', "Nombre d'articles par pages", true) ?>
    <?= $form->input('imageGap', 'Écart entre les images des post (en px)', true) ?>
    <button type="submit" class="btn btn-primary mb-3"><?= $button ?></button>
</form>