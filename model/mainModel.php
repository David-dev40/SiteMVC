<?php 
require_once __DIR__.'/../db/connexiondb.php';
require_once __DIR__.'/../controller/mainController.php';


function registerNewUser($lastname,$firstname,$username,$passuser,$question,$reponse)
{
   $dbco=dbconnect();
   $requser=$dbco->prepare('INSERT INTO account(nom, prenom, username, passuser, question, reponse) VALUES (:nom, :prenom, :username, :passuser, :question, :reponse)');
   $requser->execute(array(
      'nom'=> $lastname,
      'prenom'=> $firstname,
      'username'=> $username,
      'passuser'=> md5($passuser),
      'question'=> $question,
      'reponse'=>  $reponse
   )); // <-
   
}/*dd($_POST); */


/* fonction ci-dessous : ancien code */
/*function getUserLogin($username, $passuser)
{
   $dbco=dbConnect();
   $username=htmlspecialchars($_POST["username"]);
   $passuser=($_POST["passuser"]);
   $valider=$_POST["Valider"];
   $erreur="";
    if(isset($valider)){
       include_once ("connexiondb.php");
       $sel=$dbco->prepare("SELECT * from account where username=? and passuser=? limit 1");
       $sel->execute(array($username,$passuser));
       $tab=$sel->fetchAll();
       if(count($tab)>0){
          $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
          " ".strtoupper($tab[0]["nom"]);
          $_SESSION["connect"]= $headerIn;
          header("location:home.php"); // à mettre dans le Header pour affichage sur toutes les pages par le template
       }
       else
          $erreur="Mauvais nom d'utilisateur ou mot de passe!";
    }
}*/

function getUserLogin($username, $passuser){

   $username=htmlspecialchars($_POST["username"]);
   $passuser=htmlspecialchars($_POST["passuser"]);
   $passuser=md5($_POST["passuser"]);
   $seconnecter=$_POST["SeConnecter"];
   $erreur="";

   $dbco=dbConnect();

    if(isset($SeConnecter)){
       include_once ("connexiondb.php");
       $sel=$dbco->prepare("SELECT * from account where username=? and passuser=? limit 1");
       $sel->execute(array("username" => $username, "passuser" => $passuser));
       $tab=$sel->fetchAll();
       if(count($tab)>0){
          $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
          " ".strtoupper($tab[0]["nom"]);
          $_SESSION["connect"]= $headerIn;
          header("location:home.php"); // à mettre dans le Header pour affichage sur toutes les pages par le template
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

function getPosts()
{
    $dbco = dbConnect();
    $req = $dbco->query('SELECT id_post, id_user, id_acteur, post DATE_FORMAT(date_add, \'%d/%m/%Y à %Hh%imin%ss\') AS date_add_fr FROM post ORDER BY date_add DESC LIMIT 0, 5');

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

function listPosts()
{
    $posts = getPosts();

    require('listPostsView.php');
}

function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require('postView.php');
}




