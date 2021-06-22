<?php 
require_once __DIR__.'/../db/connexiondb.php';
require_once __DIR__.'/../controller/mainController.php';


function registerNewUser()
{
   session_start();
   @$lastname=$_POST["nom"];
   @$firstname=$_POST["prenom"];
   @$username=$_POST["username"];
   @$passuser=$_POST["passuser"];
   @$checkpass=$_POST["checkpass"];
   @$question=$_POST["question"];
   @$reponse=$_POST["reponse"]; 
   @$valider=$_POST["valider"];
   @$erreur="";
   if(isset($valider)){
   @$lastname=$_POST["nom"];
      if(empty($lastname)) $erreur="Nom laissé vide!";
      elseif(empty($firstname)) $erreur="Prénom laissé vide!";  
      elseif(empty($username)) $erreur="Nom d'utilisateur laissé vide!";
      elseif(empty($passuser)) $erreur="Mot de passe laissé vide!";
      elseif($passuser!=$checkpass) $erreur="Mots de passe non identiques!";
      elseif(empty($question)) $erreur="Question laissée vide!";     
      elseif(empty($reponse)) $erreur="Réponse laissée vide!"; 
      else {
         include_once dbConnect();
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
}/*dd($_POST); */


function getUserLogin($username, $passuser)
{
   $db=dbConnect();
   $username=htmlspecialchars($_POST["username"]);
   $passuser=md5($_POST["passuser"]);
   $valider=$_POST["Valider"];
   $erreur="";
    if(isset($valider)){
       include_once ("connexion.php");
       $sel=$dbco->prepare("SELECT * from account where username=? and passuser=? limit 1");
       $sel->execute(array($username,$passuser));
       $tab=$sel->fetchAll();
       if(count($tab)>0){
          $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
          " ".strtoupper($tab[0]["nom"]);
          $_SESSION["connect"]= $headerIn;
          header("location:index.php"); // à mettre dans le Header pour affichage sur toutes les pages par le template
       }
       else
          $erreur="Mauvais nom d'utilisateur ou mot de passe!";
    }
}


function getBillets()
{
	$dbco=dbConnect();
   $req = $dbco->query('SELECT id_post, id_user, id_acteur, post, DATE_FORMAT(date_add, \'%d/%m/%Y à %Hh%i\') AS date_add_fr FROM post ORDER BY date_add DESC LIMIT 0, 5');
   return $req;
}

function getActeur()
{
   $dbco=dbConnect();
   $req = $dbco->query('SELECT * FROM acteur'); 
   return $req;
   
}

function getPost($postId)
{
   $dbco=dbConnect();
   $req = $dbco->prepare('SELECT * FROM post');
   $req->execute>(array($postId));
   $post = $req->fetch();
   return $post;
}

function getComments($postId)
{
   $dbco=dbConnect();
   $comments = $dbco->prepare('SELECT * FROM post');
   $comments->execute>(array($postId));
   return $comments;
}







