<?php
$pageTitle = 'Connexion à GBAF';
$header = 'noconnect'; 
//dd('test');
require_once('controller/mainController.php');

//session_start();
ob_start();
?>
<main>
    <section class="form">

      <h1>Connectez-vous</h1>
   
      <form method="post" action="index.php?action=login">
         <input type="text" name="username" placeholder="Nom d'utilisateur" /><br />
         <input type="password" name="passuser" placeholder="Mot de passe" /><br />
         <input type="submit" name="SeConnecter" value="Se connecter" />
      </form>
      <p>Pas encore de compte ? <a href="index.php?action=pageRegister">Inscrivez-vous !</a></p>
      <p>Mot de passe oublié ? <a href="index.php?action=forgetpass">Créez un nouveau mot de passe</a></p> <!-- // forgetpass A CODER -->
    </section>
</main>

<?php
//include 'home.php';
$pageContent = ob_get_clean();
require_once __DIR__.'/../view/template.php';

?>

