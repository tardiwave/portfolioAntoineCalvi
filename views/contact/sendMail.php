<?php
    require '../vendor/autoload.php';
    use \Mailjet\Resources;
    use App\Connection;
    use App\Table\SettingsTable;
    $pdo = Connection::getPDO();
    $settingsTable = new SettingsTable($pdo);
    $settings = $settingsTable->find(1);
    $publicKey = $settings->getMailJetPublicKey();
    $privateKey = $settings->getmailJetPrivateKey();

    $router->template = "templateMain";
    $pageTitle = "Contact";

    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $mj = new \Mailjet\Client($publicKey, $privateKey, true, ['version' => 'v3.1']);
    $body = [
        'Messages' => [
        [
            'From' => [
            'Email' => $email,
            'Name' => $name
            ],
            'To' => [
            [
                'Email' => "tardivelantoine@gmail.com",
                'Name' => "Antoine"
            ]
            ],
            'Subject' => $subject,
            'TextPart' => $message,
            'HTMLPart' => "<h3>Nouveau message venant de <a href='https://www.antoinecalvi.fr/'>votre site</a> !</h3><br />" . $message,
            'CustomID' => "contactMail"
        ]
        ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    $response->success();

    $mailStatus = $response->getData()["Messages"][0]["Status"];

    if($mailStatus === "success"){
        $pageDescription = "Merci pour ton message !";
    ?>
        <h1 class="notFoundTitle">Contact</h1>
        <h2 class="notFoundSubTitle">Merci pour ton message 🙌 J'y réponds dès que possible.</h2>
    <?php
    }else {
        $pageDescription = "Ton message ne s'est pas envoyé :( Retente dans quelques instants ou vérifie ton message";
    ?>
        <h1 class="notFoundTitle">Contact</h1>
        <h2 class="notFoundSubTitle">Ton message ne s'est pas envoyé 😢 Retente dans quelques instants ou vérifie ton message</h2>
    <?php
    }
?>
<a class="notFoundButton" href="<?= $router->url('home') ?>">Retourner à l'accueil</a>