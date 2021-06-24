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
      'passuser'=> $passuser,
      'question'=> $question,
      'reponse'=>  $reponse
   )); // <-
   
} 


function getUserLogin($username, $passuser)
{
   $dbco=dbConnect();
   $username=htmlspecialchars($_POST["username"]);
   $passuser=htmlspecialchars($_POST["passuser"]);
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
         header("location:index.php?action=home.php"); // à mettre dans le Header pour affichage sur toutes les pages par le template
      }
      else
         $erreur="Mauvais nom d'utilisateur ou mot de passe!";
   }
} 

/*function getUserLogin($username, $passuser){

   $username=htmlspecialchars($_POST["username"]);
   $passuser=htmlspecialchars($_POST["passuser"]);
   $passuser=md5($_POST["passuser"]);
   $SeConnecter=$_POST["SeConnecter"];
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


}  */

function getAnswer($username,$reponse)
{
   
   $dbco = dbConnect();
   $req = $dbco->prepare('SELECT nom, prenom username, passuser, question, reponse FROM account WHERE username = ? AND reponse = ?');
   $req->execute(array($username, $reponse));
   $reponse = $req->fetch();
   return $reponse;
}

function updatePass($passuser, $username)
{
   $dbco = dbConnect();
   $req = $dbco->prepare('UPDATE account SET passuser = ? WHERE username = ?');
   $req->execute(array($passuser, $username));
}

function updateUsername($newUsername, $username)
{
   $dbco = dbConnect();
   $req = $dbco->prepare('UPDATE account SET username = ? WHERE username = ?');
   $req->execute(array($newUsername, $username));
}

function updateLastname($newLastname, $username)
{
   $dbco = dbConnect();
   $req = $dbco->prepare('UPDATE account SET nom = ? WHERE username = ?');
   $req->execute(array($newLastname, $username));
}

function updateFirstname($newFirstname, $username)
{
   $dbco = dbConnect();
   $req = $dbco->prepare('UPDATE account SET prenom = ? WHERE username = ?');
   $req->execute(array($newFirstname, $username));
}

function updateQuestionAnswer($newQuestion, $newAnswer, $username)
{
   $dbco = dbConnect();
   $req = $dbco->prepare('UPDATE account SET question = ?, reponse = ? WHERE username = ?');
   $req->execute(array($newQuestion, $newAnswer, $username));
}

function getComment($id_actor)
{
   $dbco = dbConnect();
    $listComment = $dbco->prepare('SELECT post.post, DATE_FORMAT(date_add, \'%d/%m/%Y à %Hh%imin%ss\') AS date_add_fr, account.firstname, account.id FROM post
      LEFT JOIN account ON post.id_user = account.id_user
      WHERE post.id_acteur = ? ORDER BY post.date_add DESC');
    $listComment->execute(array($id_actor));
    return $listComment;
}

function getVoteByActor($id_actor)
{
   $dbco = dbConnect();
   $listVotes = $dbco->prepare('SELECT * FROM vote WHERE id_acteur= ?');
   $listVotes->execute(array($id_actor));
   return $listVotes;
}

function getLikeByActor($id_actor)
{
   $dbco = dbConnect();
   $req = $dbco->prepare('SELECT COUNT(vote.vote) AS nb_vote FROM vote WHERE id_acteur = ? AND vote = 1');
   $req->execute(array($id_actor));
   $like = $req->fetch(); 
   return $like;
}

function getDislikeByActor($id_actor)
{
   $dbco=dbConnect();
   $req = $dbco->prepare('SELECT COUNT(vote.vote) AS nb_vote FROM vote WHERE id_acteur = ? AND vote = 0');
   $req->execute(array($id_actor));
   $dislike = $req->fetch();
   return $dislike;
}

function getLikes()
{
   $dbco=dbConnect();
   $listLikes = $dbco->query('SELECT COUNT(*) AS vote, id_acteur FROM vote WHERE vote = 1 GROUP BY id_acteur');
   $likes = $listLikes->fetchAll();
   return $likes;
}

function getDislikes()
{
   $dbco=dbConnect();
   $listDislikes = $dbco->query('SELECT COUNT(*) AS nb_dislikes, id_acteur FROM vote WHERE vote = 0 GROUP BY id_acteur');
   $dislikes = $listDislikes->fetchAll();
   return $dislikes;
}

function getCommentExist($id_actor, $id_user)
{
   $dbco=dbConnect();
   $req = $dbco->prepare('SELECT post.post FROM post
      LEFT JOIN account ON post.id_user = id_user.id_post
      WHERE post.id_acteur = ? AND post.id_user = ?');
   $req->execute(array($id_actor, $id_user));
   $commentExist = $req->fetch();
   return $commentExist;
}

function getVoteExist($id_actor, $id_member)
{
   $dbco=dbConnect();
   $req = $dbco->prepare('SELECT vote.vote FROM vote
      LEFT JOIN account ON vote.id_user = account.id_vote
      WHERE vote.id_acteur = ? AND vote.id_user = ?');
   $req->execute(array($id_actor, $id_member));
   $voteExist = $req->fetch();
    return $voteExist;
}

function insertComment($comment, $idActor, $idMember)
{
   $dbco=dbConnect();
   $req = $dbco->prepare('INSERT INTO post(id_user, id_acteur, date_add, post) VALUES(:post, NOW(), :id_acteur, :id_user)');
   $req->execute(array(
      'id_user' => $idMember,
      'id_acteur' => $idActor,
      'post' => $comment,
   ));
}

function insertLike($vote, $idActor, $idMember)
{
   $dbco=dbConnect();
   $req = $dbco->prepare('INSERT INTO vote(id_user, id_acteur, vote) VALUES(:id_user, :id_acteur, :vote)');
   $req->execute(array(
      'id_user' => $idMember,
      'id_acteur' => $idActor,
      'vote' => $vote,
   ));
}

function getActors()
{
   $dbco=dbConnect();
   $listActor = $dbco->query('SELECT * FROM acteur');

   $actors = $listActor->fetchAll();
   return $actors;
   
}

function getActor($idActor)
{
   $dbco = dbConnect();
   $actorInfo = $dbco->prepare('SELECT * FROM acteur WHERE id = ?');
   $actorInfo->execute(array($idActor));
   $actor = $actorInfo->fetch();
   return $actor;
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

function getUser($username)
{
   $dbco = dbConnect();
   $requser = $dbco->prepare('SELECT nom, prenom, username, passuser, question, reponse FROM account WHERE username = ?');
   $requser->execute(array($username));
   $user = $requser->fetch();
   return $user; 
} 




