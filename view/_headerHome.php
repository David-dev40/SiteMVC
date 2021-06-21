

        <header id="header">
            <a href="index.php"><img id="logo" src="/SiteMVC/public/img/logo_gbaf.png" alt="logo de GBAF"/></a>
            <div id="user">
                <div class="fas fa-user-tie fa-2x"></div>
                <div id="userLink">
                    <p><a href="index.php?action=account"><?= $_SESSION['firstname']; ?> <?= $_SESSION['lastname']; ?></a></p>
                    <p id="deco"><a href="index.php?action=logout">Se déconnecter</a></p>
                </div>
            </div>
        </header>
       
