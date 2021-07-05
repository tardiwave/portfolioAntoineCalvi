<footer class="footerContainer">
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
                    <h3 class="aboutSubTitle">Antoine Calvi</h3>
                    <ul>
                        <li>
                            <p class="aboutInfos">Designer Graphique</p>
                        </li>
                        <li>
                            <p class="aboutInfos">21 ans</p>
                        </li>
                    </ul>
                    <h3 class="aboutSubTitle">Status</h3>
                    <p class="aboutInfos">Disponible</p>
                    <h3 class="aboutSubTitle">Desciption</h3>
                    <p class="aboutInfos">Bonjour! Je m'appelle Antoine Tardivel, je suis actuellement en deuxième année de DUT métier du multimédia et de l'internet (MMI), en France à l'IUT Bordeaux Montaigne. Je cherche en ce moment un stage sur Paris dans une agence en tant que développeur full stack ou front. sur la période 19 avril au 28 juin.</p>
                    <p class="aboutInfos">Bonjour! Je m'appelle Antoine Tardivel, je suis actuellement en deuxième année de DUT métier du multimédia et de l'internet (MMI), en France à l'IUT Bordeaux Montaigne. Je cherche en ce moment un stage sur Paris dans une agence en tant que développeur full stack ou front. sur la période 19 avril au 28 juin.</p>
                </div>    
            </div>
            <div id="aboutScrollBarContainer" class="modalScrollBarContainer">
                <div id="aboutScrollBar" class="modalScrollBar">
                    <div id="aboutScroll" class="modalScroll"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="contact" class="modal">
        <div class="modalHeader">
            <h2 id="contactTitle" class="modalTitle">Contact</h2>
            <div class="modalCrossContainer" id="contactCrossContainer">
                <svg class="modalCross" viewBox="0 0 386.667 386.667" xmlns="http://www.w3.org/2000/svg">
                    <path d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z"/>
                </svg>
            </div>
        </div>
        <div id="contactInfoBlock">
            <div id="contactScrollable" class="modalScrollable">
                <div id="contactScrollableContent" class="modalScrollableContent">
                    <!-- content -->
                </div>    
            </div>
            <div id="contactScrollBarContainer" class="modalScrollBarContainer">
                <div id="contactScrollBar" class="modalScrollBar">
                    <div id="contactScroll" class="modalScroll"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="wink" class="modal">
        <div class="modalHeader">
            <h2 id="winkTitle" class="modalTitle">???</h2>
            <div class="modalCrossContainer" id="winkCrossContainer">
                <svg class="modalCross" viewBox="0 0 386.667 386.667" xmlns="http://www.w3.org/2000/svg">
                    <path d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z"/>
                </svg>
            </div>
        </div>
        <div id="winkInfoBlock">
            <div id="winkScrollable" class="modalScrollable">
                <div id="winkScrollableContent" class="modalScrollableContent">
                    <!-- content -->
                </div>    
            </div>
            <div id="winkScrollBarContainer" class="modalScrollBarContainer">
                <div id="winkScrollBar" class="modalScrollBar">
                    <div id="winkScroll" class="modalScroll"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="footerRow">
        <div class="footerMenu">
            <div class="footerMenuRow">
                <p class="footerMenuRowItem footerMenuRowItem1" id="aboutMenuButton">à propos</p>
                <p class="footerMenuRowItem footerMenuRowItem2" id="winkMenuButton">???</p>
            </div>
            <div class="footerMenuRow">
                <p class="footerMenuRowItem footerMenuRowItem3" id="contactMenuButton">contact</p>
                <a href="" class="footerMenuRowItem footerMenuRowItem4">TOUS MES TRAVAUX</a>
            </div>
        </div>
        <div class="footerChangeColorContainer" >
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
