<?php

require_once __DIR__.'/../model/mainModel.php';

function pageHome()                                 //<-----------------------ok
{
    $actors = getActors();
    $likes = getLikes();
    $dislikes = getDislikes();
    $likesByActor = [];
    foreach ($likes as $like) {
        $likesByActor += array($like['actor_id'] => $like['nb_likes']);
    }
    $dislikesByActor = [];
    foreach ($dislikes as $dislike) {
        $dislikesByActor += array($dislike['actor_id'] => $dislike['nb_dislikes']);
    }
    require_once __DIR__.'/../view/home.php';
    //dd('je suis dans la page home',1,true);  
}

function connexiondb()
{
    require_once __DIR__.'/../db/connexiondb.php';
    //dd('je suis dans la page connexiondb',1,true);
}

function pageAccount()                         //--------------------------ok
{
    require_once __DIR__.'/../view/account.php';
    //dd('je suis dans la page account',1,true);
}

function pageRegister()                         //<--------------------------ok
{
    require_once __DIR__.'/../view/register.php'; 
}

function pageLogin()                            //<--------------------------ok
{
    require_once __DIR__.'/../view/login.php';  
}

function login()                          //<------------- A VOIR
{
    {
        //session_start();
        if(!empty($_POST)){
            
            $username= htmlspecialchars($_POST["username"]);
            $passuser= htmlspecialchars($_POST["passuser"]);
            $passuser=md5($passuser);
            $erreur="";
            
            $dbco = dbConnect();
            $sel=$dbco->prepare("SELECT * from account where username=? and passuser=? limit 1");
            $sel->execute(array($username, $passuser));
            $tab=$sel->fetchAll();
            
            if(count($tab)>0){
                session_start();

                $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
                " ".strtoupper($tab[0]["nom"]);
                $_SESSION["autoriser"]="oui";
                header("location:index.php?action=pageHome"); // à mettre peut-être plutôt dans le Header pour affichage sur toutes les pages par le template ? 
            }
            else{
                $erreur="Mauvais nom d'utilisateur ou mot de passe!";
                //dd($erreur);
                
            }
            
    
        }
        
    
      
        require_once __DIR__.'/../view/login.php';
    }
}
    
    
    function logout()                           //<-----------------------------ok
{
    session_start();
    session_destroy();
    header("location:index.php?action=login");
    exit();
}

function pageForgetpass()                    //<---------------------------ok
{
    require_once __DIR__.'/../view/forgetpass.php';
}

function forgetPassUsername($usernamePost)   
{
    $username = htmlspecialchars($usernamePost);
    $userExist = getUser($username);
    $question = $userExist['question'];
    if (empty($userExist)) {
        $errorUsername = 'Utilisateur inconnu';
    }
    include_once __DIR__. 'view/forgetpass.php';
}

function forgetPassQuestion($answerPost)
{
    $answer = htmlspecialchars($_POST['reponse']);
    $username = $_POST['username'];
    $answerExist = getAnswer($answer, $username);
    if (empty($answerExist)) {
        $errorAnswer = 'Réponse incorrecte';
        $userExist = getUser($username);
        $question = $userExist['question'];
    }
    include_once __DIR__. '/../view/forgetpass.php';
}

function forgetPassNew($usernamePost, $newpassPost, $checkpassPost) //<-----------------ok
{
    $username = $usernamePost;
    $newpass = htmlspecialchars($newpassPost);
    $checkpass = htmlspecialchars($checkpassPost);
    if (empty($newpass) OR strlen($newpass) > 20 OR strlen($newpass) < 4) {
        $errorPass = 'Le mot de passe est vide ou est trop long ou trop court';
    } else {
        if ($newpass != $checkpass) {
            $diffPass = 'Le mot de passe n\'est pas identique';
        } else {
            $pass_hache = password_hash($newpass, PASSWORD_DEFAULT);
            updatePass($pass_hache, $username);
            header('Location: index.php');
            exit();
        }
    }
    require_once __DIR__.'/../view/forgetpass.php';
}

function changeUsername($usernamePost)
{
    $newUsername = htmlspecialchars($usernamePost);
    $testUsername = getUser($newUsername);
    if (!empty($testUsername)) {
        $errorUsername = 'Ce nom d\'utilisateur est déjà pris veuillez en saisir un autre';
    } elseif (empty($newUsername) OR strlen($newUsername) > 20 OR strlen($newUsername) < 4) {
        $errorUsername = 'Le nom d\'utilisateur est vide ou est trop long ou trop court';
    } else {
        updateUsername($newUsername, $_SESSION['username']);
        $_SESSION['username'] = $newUsername;
        $confirmUsername = 'Votre nom d\'utilisateur a bien été changé';
    }
    require_once __DIR__.'/../view/account.php';
}

function changePass($newpassPost, $checkpassPost)   //<--------------------------ok
{
    $newpass = htmlspecialchars($newpassPost);
    $checkpass = htmlspecialchars($checkpassPost);
    if (empty($newpass) OR strlen($newpass) > 20 OR strlen($newpass) < 4) {
        $errorPass = 'Le mot de passe est vide ou est trop long ou trop court';
    } elseif ($newpass != $checkpass) {
        $diffPass = "Vos mots de passe saisis ne sont pas identiques, Réessayez";
    } else {
        $pass_hache = password_hash($newpass, PASSWORD_DEFAULT);
        updatePass($pass_hache, $_SESSION['username']);
        $confirmPassword = 'Votre mot de passe a bien été changé';
    }
    require_once __DIR__.'/../view/account.php';
}

function changeLastname($lastnamePost)              //<-----------------------ok
{
    $newLastname = htmlspecialchars($lastnamePost);
    if (empty($newLastname) OR strlen($newLastname) > 30) {
        $errorLastname = 'Le nom est vide ou est trop long';
    } else {
        updateLastname($newLastname, $_SESSION['username']);
        $_SESSION['lastname'] = $newLastname;
        $confirmLastname = 'Votre nom a bien été changé';
    }
    require_once __DIR__.'/../view/account.php';
}

function changeFirstname($firstnamePost)             //<------------------------ok
{
    $newFirstname = htmlspecialchars($firstnamePost);
    if (empty($newFirstname) OR strlen($newFirstname) > 30) {
        $errorFirstname = 'Le prénom est vide ou est trop long';
    } else {
        updateFirstname($newFirstname, $_SESSION['username']);
        $_SESSION['firstname'] = $newFirstname;
        $confirmFirstname = 'Votre prénom a bien été changé';
    }
    require_once __DIR__.'/../view/account.php';
}

function changeQuestionAnswer($questionPost, $answerPost)
{
    $newQuestion = htmlspecialchars($questionPost);
    $newAnswer = htmlspecialchars($answerPost);
    if (empty($newQuestion) OR strlen($newQuestion) > 150) {
        $errorQuestion = 'La question est vide ou est trop longue';
    } elseif (empty($newAnswer) OR strlen($newAnswer) > 50) {
        $errorAnswer = 'La réponse est vide ou est trop longue';
    } else {
        updateQuestionAnswer($newQuestion, $newAnswer, $_SESSION['username']);
        $confirmQuestionAnswer = 'Vos question/réponse ont bien été changées';
        $user = getUser($_SESSION['username']);
    }
    require_once __DIR__. '/../view/account.php';
}

function pageActor()
{
    $member = getUser($_SESSION['username']);
    $commentExist = getCommentExist($_GET['id_acteur'],$member['id_user']);
    $voteExist = getVoteExist($_GET['id_acteur'],$member['id_user']);
    $actor = getActor($_GET['id_acteur']);
    $like = getLikeByActor($_GET['id_acteur']);
    $dislike = getDislikeByActor($_GET['id_acteur']);
    $listComment = getComment($_GET['id_acteur']);
    $comments = $listComment->fetchAll();
    $listVotes = getVoteByActor($_GET['id_acteur']);
    $votes = $listVotes->fetchAll();
    $votesByActor = [];
    foreach ($votes as $vote) {
    $votesByActor += array($vote['id_user'] => $vote['vote']);
    }
    require_once __DIR__.'/../view/actor.php';
}

function addCommentActor($commentPost)
{
    $member = getUser($_SESSION['username']);
    $commentExist = getCommentExist($_GET['id_acteur'],$member['id_user']);
    $comment = htmlspecialchars($commentPost);
    $idActor = $_GET['id_acteur'];
    $errors = 0;
    if(!empty($commentExist)) {
        $errors++;
        $errorComment = "Vous avez déjà écrit un commentaire ici";
    }
    if (empty($comment) OR strlen($comment) > 500) {
        $errors++;
        $errorComment = "vide ou trop long";
    }
    if ($errors === 0) {
        insertComment($comment, $idActor, $member['id_user']);
        $commentExist = getCommentExist($_GET['id_acteur'],$member['id_user']);
    }
    $member = getUser($_SESSION['username']);
    $commentExist = getCommentExist($_GET['id_actor'],$member['id_user']);
    $voteExist = getVoteExist($_GET['id_acteur'],$member['id_user']);
    $actor = getActor($_GET['id_acteur']);
    $like = getLikeByActor($_GET['id_acteur']);
    $dislike = getDislikeByActor($_GET['id_acteur']);
    $listComment = getComment($_GET['id_acteur']);
    $comments = $listComment->fetchAll();
    $listVotes = getVoteByActor($_GET['id_acteur']);
    $votes = $listVotes->fetchAll();
    $votesByActor = [];
    foreach ($votes as $vote) {
        $votesByActor += array($vote['id_user'] => $vote['vote']);
    }
    require_once __DIR__.'/../view/actor.php';
}

function addVoteActor($upPost, $downPost)
{
    $member = getUser($_SESSION['username']);
    $voteExist = getVoteExist($_GET['id_acteur'],$member['id_user']);
    $like = $upPost;
    $dislike = $downPost;
    $idActor = $_GET['id_acteur'];
    if (isset($like)) {
        $vote = 1;
    }
    if (isset($dislike)) {
        $vote = 0;
    }
    insertLike($vote, $idActor, $member['id']);
    $voteExist = getVoteExist($_GET['id_acteur'],$member['id_user']);
    $member = getUser($_SESSION['username']);
    $commentExist = getCommentExist($_GET['id_acteur'],$member['id_user']);
    $voteExist = getVoteExist($_GET['id_acteur'],$member['id_user']);
    $actor = getActor($_GET['id_acteur']);
    $like = getLikeByActor($_GET['id_acteur']);
    $dislike = getDislikeByActor($_GET['id_acteur']);
    $listComment = getComment($_GET['id_acteur']);
    $comments = $listComment->fetchAll();
    $listVotes = getVoteByActor($_GET['id_acteurr']);
    $votes = $listVotes->fetchAll();
    $votesByActor = [];
    foreach ($votes as $vote) {
        $votesByActor += array($vote['id_user'] => $vote['vote']);
    }
    require_once __DIR__.'/../view/actor.php';
}

function actor()  
{
    require('model/mainModel.php');
    $req = getActor($idActor);
    $req = getComments($postId);
    require_once __DIR__.'/../view/home.php';
}

function commentaire()
{
    require_once __DIR__.'/../model/mainModel.php';
    if (isset($_GET['id_post']) && $_GET['id_post'] > 0) {
    $post = getPost($_GET['id_post']);
    $comments = getComments($_GET['id_post']);
    require_once __DIR__.'/../actor.php';
    }
    else {
        echo 'Erreur : aucun identifiant de billet envoyé';
    }

}

function register()
{
  $dbco=dbconnect();
  session_start();
  
  //$erreur= 0;
  if(!empty($_POST['SEnregistrer'])){
      //dd($_POST);
      
        if(empty($_POST['nom'])) {
            echo '<script> alert("Nom laissé vide!")</script>';
        }
        if(empty($_POST['prenom'])) {
            $erreur="Prénom laissé vide!";
        }
        if(empty($_POST['username'])) {
            $erreur="Nom d'utilisateur laissé vide!";
        }
        if(empty($_POST['password'])) {
            $erreur="Mot de passe laissé vide!";
        }
        if(empty($_POST['question'])) {
            $erreur="Question laissée vide!";
        }
        if(empty($_POST['reponse'])) {
            $erreur="Réponse laissée vide!";
        }
        else{   
            $lastname=htmlspecialchars($_POST["nom"]);
            $firstname=htmlspecialchars($_POST["prenom"]);
            $username=htmlspecialchars($_POST["username"]);
            $passuser=md5($_POST["passuser"]);
            $passuser=htmlspecialchars($passuser);
            $question=htmlspecialchars($_POST["question"]);
            $reponse=htmlspecialchars($_POST["reponse"]);

            $ins=$dbco->prepare('SELECT * FROM account WHERE username=? LIMIT 1');
            $ins->execute(array($username));
            $tabins=$ins->fetchAll();
            if(count($tabins)>0){
                //dd('bdd');
                echo 'Nom d\'utilisateur existe déjà';
            }
            else{
                //dd('entrée bdd');
                
                $tabins=$dbco->prepare('INSERT INTO account(nom, prenom, username, passuser, question, reponse) VALUES(:nom, :prenom, :username, :passuser, :question, :reponse)');
                 if($tabins->execute(array('nom'=>$lastname, 'prenom'=>$firstname, 'username'=>$username, 'passuser'=>$passuser, 'question'=>$question, 'reponse'=>$reponse))){
                  //dd('redirection');
                  header("location:index.php?action=login");
                  exit;
                 }
            }
         }  
    }

}

function mentionsLegales()
{
    require_once __DIR__.'/../view/mentionsLegales.php';
}

function contact()
{
    require_once __DIR__.'/../view/contact.php';
}