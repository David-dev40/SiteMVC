<?php
$pageTitle = 'Connexion à GBAF';
$header = 'noconnect'; 
//dd('test');
ob_start();
?>

<!--<main>
    <section class="form">
        <h1>Connectez-vous</h1>
        <form method="post" action="index.php?action=connexion">

            <p><label for="username">Nom d'utilisateur : </label><br /></br><input type="text" name="username" required /></p>

            <p><label for="passuser">Mot de passe : </label><br /></br><input type="password" name="passuser" required /></p>

            <p class="error">

           <?php #isset($errorMsg) ? $errorMsg : '' ?>

             </p></br>

            <p><input type="submit" value="Se connecter" /></p></br>
            
        </form>
        <p>Pas encore de compte ? <a href="index.php?action=pageRegister">Inscrivez-vous !</a></p>
        <p>Mot de passe oublié ? <a href="index.php?action=forgetpass">Créez un nouveau mot de passe</a></p>
    </section>
</main>
-->

<?php
#$pageContent = ob_get_clean();
#require_once __DIR__.'/../view/template.php';
?>






<?php
   session_start();
   @$username=$_POST["username"];
   @$passuser=md5($_POST["passuser"]);
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
      include_once ("_connexion.php");
      $sel=$dbco->prepare("SELECT * from account where username=? and passuser=? limit 1");
      $sel->execute(array($username,$passuser));
      $tab=$sel->fetchAll();
      if(count($tab)>0){
         $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
         " ".strtoupper($tab[0]["nom"]);
         $_SESSION["autoriser"]="oui";
         header("location:_session.php");
      }
      else
         $erreur="Mauvais nom d'utilisateur ou mot de passe!";
   }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      
   </head>
   <body onLoad="document.fo._login2.focus()">
      <h1>Authentification [ <a href="_inscription.php">Créez un compte</a> ]</h1>
      <div class="erreur"><?php echo $erreur ?></div>
      <form name="fo" method="post" action="">
         <input type="text" name="username" placeholder="Nom d'utilisateur" /><br />
         <input type="password" name="passuser" placeholder="Mot de passe" /><br />
         <input type="submit" name="valider" value="S'authentifier" />
      </form>
   </body>
</html>