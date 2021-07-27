<?php
    use App\Connection;
    use App\Table\UserTable;
    use App\Table\NewsTable;
    use App\Auth;

    $pdo = Connection::getPDO();
    $userTable = new UserTable($pdo);
    $newsTable = new NewsTable($pdo);
    $user = $userTable->findByUsername('admin');
    $news = $newsTable->find(1);


    $firstname = $user->getFirstname();
    $lastname = $user->getLastname();
    $work = $user->getWork();
    $date = ($user->getBirth()->format('Y-m-d'));
    $age = date('Y') - $date; 
    if (date('md') < date('md', strtotime('2000-07-11'))) { 
        $age = $age - 1; 
    } 
    $status = $user->getStatus();
    $description = $user->getDescription();
?>
<footer class="footerContainer">
    <div id="menuBgAbout" class="menuBgModal"></div>
    <div id="about" class="modal">
        <div class="modalHeader">
            <h2 id="aboutTitle" class="modalTitle">Informations</h2>
            <div class="modalCrossContainer" id="aboutCrossContainer">
                <svg class="modalCross" viewBox="0 0 386.667 386.667" xmlns="http://www.w3.org/2000/svg">
                    <path d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z"/>
                </svg>
            </div>
        </div>
        <div id="aboutInfoBlock" class="modalContentBlock">
            <div id="aboutScrollable" class="modalScrollable">
                <div id="aboutScrollableContent" class="modalScrollableContent">
                    <?php if($username || $lastname): ?>
                    <h3 class="aboutSubTitle"><?= $firstname ?> <?= $lastname ?></h3>
                    <?php endif; ?>
                    <ul>
                        <?php if($work): ?>
                        <li>
                            
                            <p class="aboutInfos"><?= $work ?></p>
                        </li>
                        <?php endif; ?>
                        <?php if($age): ?>
                        <li>
                            <p class="aboutInfos"><?= $age ?></p>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <h3 class="aboutSubTitle">Status</h3>
                    <p class="aboutInfos">
                        <?php
                            if($status === 'on'){
                                echo 'Disponible';
                            } else {
                                echo 'Indisponible';
                            }
                        ?>
                    </p>
                    <?php if($description): ?>
                    <h3 class="aboutSubTitle">Desciption</h3>
                    <p class="aboutInfos"><?= $description ?></p>
                    <?php endif; ?>
                    
                </div>    
            </div>
            <div id="aboutScrollBarContainer" class="modalScrollBarContainer">
                <div id="aboutScrollBar" class="modalScrollBar">
                    <div id="aboutScroll" class="modalScroll"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="menuBgContact" class="menuBgModal"></div>
    <div id="contact" class="modal">
        <div class="modalHeader">
            <h2 id="contactTitle" class="modalTitle">Contact</h2>
            <div class="modalCrossContainer" id="contactCrossContainer">
                <svg class="modalCross" viewBox="0 0 386.667 386.667" xmlns="http://www.w3.org/2000/svg">
                    <path d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z"/>
                </svg>
            </div>
        </div>
        <div id="contactInfoBlock" class="modalContentBlock">
            <div id="contactScrollable" class="modalScrollable">
                <div id="contactScrollableContent" class="modalScrollableContent">
                    <form action="/contact" method="post" class="contactForm" >
                        <div class></div>
                        <label for="name" class="contactLabel">Nom :</label>
                        <input type="text" name="name" id="contactName" class="contactInput" placeholder="Votre nom">
                        <label for="email" class="contactLabel">Email :</label>
                        <input type="email" name="email" id="contactEmail" class="contactInput" placeholder="Votre mail">
                        <label for="subject" class="contactLabel">Sujet :</label>
                        <input type="text" name="subject" id="contactSubject" class="contactInput" placeholder="Sujet de votre message">
                        <label for="message" class="contactLabel">Message :</label>
                        <textarea type="text" name="message" id="contactMessage" class="contactTextArea" placeholder="Votre message" rows="5"></textarea>
                        <button type="submit" class="contactButton">Envoyer</button>
                    </form>
                </div>    
            </div>
            <div id="contactScrollBarContainer" class="modalScrollBarContainer">
                <div id="contactScrollBar" class="modalScrollBar">
                    <div id="contactScroll" class="modalScroll"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="menuBgNews" class="menuBgModal"></div>
    <div id="news" class="modal">
        <div class="modalHeader">
            <h2 id="newsTitle" class="modalTitle">News</h2>
            <div class="modalCrossContainer" id="newsCrossContainer">
                <svg class="modalCross" viewBox="0 0 386.667 386.667" xmlns="http://www.w3.org/2000/svg">
                    <path d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z"/>
                </svg>
            </div>
        </div>
        <div id="newsInfoBlock">
            <div id="newsScrollable" class="modalScrollable">
                <div id="newsScrollableContent" class="newsContent">
                    <?php 
                        $newsContent = $news->getContent();
                        $newsTilte = $news->getTitle();
                        $newsLinkText = $news->getLinkText();
                        $newsLink = $news->getLink();
                    if($newsContent):
                    ?>
                        <h3 class="newsTitle"><?= $newsTilte; ?></h3>
                        <p class="newsInfos"><?= $news->getContent(); ?></p>
                        <?php if($newsLink): ?>
                            <a class="newsLink" target="_blank" href="<?= $newsLink ?>">
                                <?php
                                    if($newsLinkText){
                                        echo $newsLinkText;
                                    }else{
                                        echo 'Consulter';
                                    }
                                ?>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <h3 class="newsTitle">Pas de news à afficher</h3>
                    <?php endif; ?>
                </div>
            </div>
            <div id="newsScrollBarContainer" class="modalScrollBarContainer">
                <div id="newsScrollBar" class="modalScrollBar">
                    <div id="newsScroll" class="modalScroll"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="menuBg"></div>
    <div id="menu" class="modal">
        <div class="modalHeader">
            <h2 class="modalTitle">Menu</h2>
            <div class="modalCrossContainer" id="menuCrossContainer">
                <svg class="modalCross" viewBox="0 0 386.667 386.667" xmlns="http://www.w3.org/2000/svg">
                    <path d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z"/>
                </svg>
            </div>
        </div>
        <div id="menuInfoBlock">
            <p class="mobileMenuRowItem" id="aboutMenuButtonMobile">À propos</p>
            <p class="mobileMenuRowItem" id="newsMenuButtonMobile">News</p>
            <p class="mobileMenuRowItem" id="contactMenuButtonMobile">Contact</p>
            <a href="<?= $router->url('posts'); ?>" class="mobileMenuRowItem">Tous mes travaux</a>
            <?php  if(Auth::check()): ?>
                <a href="<?= $router->url('admin') ?>" class="mobileMenuRowItem">admin</a>
                <form class="mobileMenuRowItemForm" action="<?= $router->url('logout') ?>" method="POST">
                    <button type="submit" class="mobileMenuRowItem">Se déconnecter</button>
                </form>
            <?php else: ?>
                <a href="<?= $router->url('login') ?>" class="mobileMenuRowItem">Se connecter</a>
            <?php endif; ?>
        </div> 
    </div>
    <div class="footerRow">
        <div class="footerMenu">
            <div class="footerMenuRow">
                <p class="footerMenuRowItem footerMenuRowItem1" id="aboutMenuButton">À propos</p>
                <p class="footerMenuRowItem footerMenuRowItem2" id="newsMenuButton">News</p>
            </div>
            <div class="footerMenuRow">
                <p class="footerMenuRowItem footerMenuRowItem3" id="contactMenuButton">Contact</p>
                <a href="<?= $router->url('posts'); ?>" class="footerMenuRowItem footerMenuRowItem4">Tous mes travaux</a>
            </div>
        </div>
        <div class="footerChangeColorContainer" >
            <p class="footerMenuRowItem" id="menuButton">Menu</p>
            <div class="footerChangeColorText">
                <p>change color</p>
                <p id="footerChangeColorTextReset">reset</p>
            </div>
            <input class="footerChangeColorRange" type="range" id="typeinp" min="0" max="100" value="50" step="1" onChange="footerChangeColorRange(event)">
        </div>
    </div>
</footer>
<?php ob_start(); ?>
    <script src="/scripts/footer.js"></script>
<?php $pageJavascripts .= ob_get_clean(); ?>
