<?php
    session_start();
    $_SESSION["prenomNom"]
?>

<!DOCTYPE html>

<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" type="text/css" media="screen" href="./public/style.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Martel%7cOpen+Sans&display=swap" />
        <link rel="icon" href="public/img/wicon_gbaf.png" />
        <title><?= $pageTitle ?></title>
    </head>
<body>
    <header>
        <?php ob_start(); ?> 
        <header id="header_form">
            <p><a href="index.php"><div><img id="logoGBAF" src ="public/img/logo_gbaf.png" alt="logo de GBAF" /></a></div></p>
            <h1>Le Groupement Banque Assurance Français</h1>
        </header>
        <?php $headerOut = ob_get_clean(); ?>

        <?php ob_start(); ?>
        <header id="header">
        <a href="index.php"><div><img id="logo" src="public/img/logo_gbaf.png" alt="logo de GBAF" /></a></div>
            <div id="user">
                <div class="fas fa-user-tie fa-2x"></div>
                <div id="userLink">

                    <p><a href="index.php?action=login">
                           <?php echo $_SESSION["prenomNom"];?>
                        </a></p>

                    <p id="deco"><a href="index.php?action=logout">Se déconnecter</a></p>

                </div>
            </div>
        </header>
   
        
        <?php $headerIn = ob_get_clean(); ?>

        <?= ($header == 'noconnect') ? $headerOut : '' ?>
        <?= ($header == 'connect') ? $headerIn : '' ?>

      

    </header>
       <main>

           <?= $pageContent ?>

        </main>
       
        <footer>
            <p><a href="#">Mentions légales</a> | <a href="#">Contact</a></p>
        </footer>
</body>
<?php dd($_GET,$_POST,$_REQUEST);?>
</html>