<?php
    use App\Auth;
    use App\Connection;
    use App\Table\UserTable;

    $pdo = Connection::getPDO();
    $userTable = new UserTable($pdo);
    $user = $userTable->findByUsername('admin');

    $instagram = $user->getInstagram();
    $behance = $user->getBehance();
?>
<nav class="headerContainer">
    <marquee class="headerTopBar">👽</marquee>
    <div class="headerContent">
        <div class="headerIconContainer" >
            <a href="https://www.antoinetardivel.com/" target="_blank">
                <svg class="headerIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 39.13 39.13">
                    <path d="M19.56,0A19.57,19.57,0,1,0,39.13,19.56,19.56,19.56,0,0,0,19.56,0ZM3.66,19.56a15.9,15.9,0,0,1,15.9-15.9v15.9Zm15.9,15.9V19.57h15.9A15.9,15.9,0,0,1,19.56,35.46Z"/>
                </svg>
            </a>
            <?php if($instagram): ?>
                <a href="<?= $instagram ?>" target="_blank">
                    <svg class="headerIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40.127 40.127">
                        <path d="M20.064,3.344a16.72,16.72,0,1,1-16.72,16.72A16.739,16.739,0,0,1,20.064,3.344Zm0-3.344A20.064,20.064,0,1,0,40.127,20.064,20.064,20.064,0,0,0,20.064,0Zm0,11.841c2.678,0,3,.01,4.055.059,2.72.124,3.988,1.413,4.113,4.111.047,1.058.057,1.374.057,4.053s-.01,3-.057,4.053c-.125,2.7-1.391,3.989-4.113,4.113-1.058.047-1.374.059-4.055.059s-3-.01-4.053-.059c-2.725-.125-3.988-1.419-4.113-4.113-.047-1.057-.059-1.374-.059-4.053s.012-3,.059-4.053c.124-2.7,1.391-3.989,4.113-4.113,1.057-.048,1.374-.057,4.053-.057Zm0-1.809c-2.725,0-3.065.012-4.136.062-3.645.167-5.668,2.189-5.835,5.833-.048,1.072-.06,1.413-.06,4.136s.012,3.066.06,4.136c.167,3.643,2.19,5.668,5.835,5.835,1.072.048,1.411.06,4.136.06s3.066-.012,4.138-.06c3.638-.167,5.67-2.189,5.833-5.835.048-1.07.06-1.411.06-4.136s-.012-3.065-.06-4.136c-.164-3.64-2.189-5.668-5.833-5.833-1.072-.05-1.413-.062-4.138-.062Zm0,4.88a5.151,5.151,0,1,0,5.151,5.151A5.152,5.152,0,0,0,20.064,14.912Zm0,8.5a3.344,3.344,0,1,1,3.346-3.344A3.343,3.343,0,0,1,20.064,23.408Zm5.354-9.9a1.2,1.2,0,1,0,1.205,1.2A1.2,1.2,0,0,0,25.417,13.506Z" />
                    </svg>
                </a>
            <?php endif; ?>
            <?php if($behance): ?>
                <a href="<?= $behance ?>" target="_blank">
                    <svg class="headerIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38.822 38.822">
                        <path d="M29.116,13.1h-6.47V11.689h6.47Zm1.359,9.908c-1.246,3.652-9.623,4.8-9.623-2.523,0-7.413,8.91-7.08,9.791-1.411a12.986,12.986,0,0,1,.089,2.02H23.6a2.288,2.288,0,0,0,3.889,1.915h2.988Zm-6.812-3.774h4.245C27.722,16.509,24.09,16.31,23.663,19.238Zm-9.476,6.593h-6.1V11.71h6.561c5.167.076,5.265,5.137,2.567,6.516C20.482,19.414,20.59,25.831,14.188,25.831Zm-3.067-8.3H14.3c2.368,0,2.743-3.007-.294-3.007H11.121Zm3,2.352h-3v3.149h2.95C16.954,23.026,16.777,19.878,14.12,19.878ZM19.411,3.235A16.176,16.176,0,1,1,3.235,19.411,16.194,16.194,0,0,1,19.411,3.235Zm0-3.235A19.411,19.411,0,1,0,38.822,19.411,19.412,19.412,0,0,0,19.411,0Z" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>
        <a href="<?= $router->url('home') ?>" class="headerTitle">Antoine Calvi</a>
        <!-- <a href="<?= $router->url('login') ?>" class="headerLogin" >Connexion</a> -->
        <div class="headerButtons">
            <?php  if(Auth::check()): ?>
                <a href="<?= $router->url('admin') ?>" class="headerLogin">admin</a>
                <form action="<?= $router->url('logout') ?>" method="POST">
                    <button type="submit" class="headerLogin">Se déconnecter</button>
                </form>
            <?php else: ?>
                <a href="<?= $router->url('login') ?>" class="headerLogin">Se connecter</a>
            <?php endif; ?>
        </div>
    </div>
</nav>