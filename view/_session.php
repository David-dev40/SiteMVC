<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:_login2.php");
      exit();
   }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      
   </head>
   <body onLoad="document.fo._login2.focus()">
      <h2><?php echo $bienvenue?></h2>
      [ <a href="_deconnexion.php">Se déconnecter</a> ]
   </body>
</html>