<?php
$pageTitle = 'Inscription sur le site GBAF';
$header = 'noconnect'; 
ob_start();
?>


<main>
    <section class="form">
        <h1>Inscription</h1>
        <form action="index.php?action=pageLogin" method="POST">
            <input type="hidden" name="register_form" value="register" />

            <p><label for="nom">Nom : </br></br></label><input type="text" name="nom" ></p>

            <p><label for="prenom">Prénom : </br></br></label><input type="text" name="prenom"></p>

            <p><label for="username">Nom d'utilisateur : </br></br></label><input type="text" name="username" ></p>

            <p><label for="passuser">Mot de passe : </br></br></label><input type="password" name="passuser" ></p>

            <p><label for="checkpass">Confirmation du Mot de passe : </br></br></label><input type="password" name="checkpass" ></p>

            <p><label for="question">Question secrète : </br></br></label><input type="text" name="question" ></p>

            <p><label for="reponse">Réponse à la question secrète : </br></br></label><input type="text" name="reponse" ></p>

            <p><input type="submit" value="Validez"/></p>
        </form>
    </section>
</main>
-->







<?php
   session_start();
   @$lastname=$_POST["nom"];
   @$firstname=$_POST["prenom"];
   @$username=$_POST["username"];
   @$passuser=$_POST["passuser"];
   @$checkpass=$_POST["checkpass"];
   @$question=$_POST["question"];
   @$reponse=$_POST["reponse"]; 
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
   @$lastname=$_POST["nom"];
      if(empty($lastname)) $erreur="Nom laissé vide!";
      elseif(empty($firstname)) $erreur="Prénom laissé vide!";  
      elseif(empty($username)) $erreur="Nom d'utilisateur laissé vide!";
      elseif(empty($passuser)) $erreur="Mot de passe laissé vide!";
      elseif($passuser!=$checkpass) $erreur="Mots de passe non identiques!";
      elseif(empty($question)) $erreur="Question laissée vide!";     
      elseif(empty($reponse)) $erreur="Réponse laissée vide!"; 
      else{
         include_once ("_connexion.php");
         $sel=$dbco->prepare('SELECT * from account where username=? limit 1');
         $sel->execute(array($username));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="Nom d'utilisateur existe déjà!";
         else{
            $ins=$dbco->prepare("INSERT into account(nom,prenom,username,passuser,question,reponse) values(?,?,?,?,?,?)");
            if($ins->execute(array($lastname,$firstname,$username,md5($passuser),$question,$reponse)))
               header("location:_login2.php");
         }   
      }
   }
?>
<?php
$pageContent = ob_get_clean();
require_once __DIR__.'/../view/template.php';
?>





