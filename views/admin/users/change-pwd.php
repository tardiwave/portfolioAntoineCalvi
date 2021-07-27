<?php

    $router->template = "templateAdmin";
    $pageTitle = "Changer Mot de passe";
    $pageDescription = "Changez votre mot de passse.";

    use App\Connection;
    use App\Models\User;
    use App\HTML\Form;
    use App\ObjectHelper;
    use App\Table\UserTable;

    $fields = ['password'];

    if(!empty($_POST['password'])){
        if($_POST['password'] === $_POST['verify']){
            $pdo = Connection::getPDO();
            $userTable = new UserTable($pdo);
            $user = $userTable->findByUsername('admin');
            $options = [
                'cost' => 14,
            ];
            $crypte = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

            ObjectHelper::hydrate($user, Array("password" => $crypte), $fields);
            $userTable->update([
                'password' => $user->getPassword(),
            ], $user->getId());
            $success = true;
        }else{
            $notSame = true;
        }
    }
    if($success){
        echo "<div class='alert alert-success' role='alert'>Mot de passe modifié</div>";
    }
    if(!empty($notSame)){
        echo "<div class='alert alert-danger' role='alert'>Les champs ne sont pas identiques</div>";
    }
?>

<div class="changePWDForm">
    <h1 class="changePWDTitle">Changer le mot de passe</h1>
    <form action="<?= $router->url('changePWD') ?>" method="post">
        <div class="form-group">
            <label for="changePWDInput">Nouveau mot de passe<span title="required">*</span></label>
            <input name="password" type="password" class="form-control" id="changePWDInput" placeholder="Nouveau mot de passe" required>
        </div>
        <div class="form-group">
            <label for="changePWDInput">Nouveau mot de passe (vérification)<span title="required">*</span></label>
            <input name="verify" type="password" class="form-control" id="changePWDInput" placeholder="Nouveau mot de passe" required>
        </div>
        <button class="btn btn-primary mt-2" type="submit">Changer</button>
    </form>
</div>