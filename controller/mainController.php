<?php

//define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

require_once __DIR__.'/../model/mainModel.php';

/*function header_form()
{
    require_once __DIR__.'/../view/header_form.php';
    dd('je suis le header');
}*/

function template()
{
    require_once __DIR__.'/../view/template.php';
}


function home()
{
    //require_once('/../model/modele.php');

    $req = getBillets();
    require_once __DIR__.'/../view/home.php';
    //dd('je suis dans la page home',1,true);  
}

/*function headerHome()
{
    require_once __DIR__.'/../view/headerHome.php';
    dd('je suis dans la page headerHome',1,true);
}  */

function connexiondb()
{
    require_once __DIR__.'/../db/connexiondb.php';
    //dd('je suis dans la page connexiondb',1,true);
}

function pageAccount()
{
    require_once __DIR__.'/../view/account.php';
    //dd('je suis dans la page account',1,true);
}

function pageRegister()
{
    require_once __DIR__.'/../view/register.php'; 
}

function register()
{
    
  require_once __DIR__.'/../view/register';

}


function pageLogin()
{
    require_once __DIR__.'/../view/login.php';
}

function login()
{
    session_start();
    if(!empty($_POST)){
        //dd($_POST);
        $username= htmlspecialchars($_POST["username"]);
        $passuser=md5($_POST["passuser"]);
        $erreur="";
        //include_once ("db/connexiondb.php");
        $dbco = dbConnect();
        $sel=$dbco->prepare("SELECT * from account where username=? and passuser=? limit 1");
        $sel->execute(array($username,$passuser));
        $tab=$sel->fetchAll();
        //dd($tab,$username,$passuser);
        if(count($tab)>0){
            $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
            " ".strtoupper($tab[0]["nom"]);
            $_SESSION["autoriser"]="oui";
        header("location:index.php?action=home"); // à mettre dans le Header pour affichage sur toutes les pages par le template
        }
        else{
            $erreur="Mauvais nom d'utilisateur ou mot de passe!";
            dd($erreur);
            // dd($_POST,$_SERVER,$_SESSION);
        }
        

    }
    

  
    require_once __DIR__.'/../view/login.php';
}


function logout()
{
    session_start();
    session_destroy();
    header("location:login.php");
}
/*function pageValidRegister()
{
    
include_once __DIR__.'/../view/validRegister.php';

}

function pageValidLogin()
{
include_once __DIR__.'/../view/validLogin.php';

}*/



function pageActor()
{
    include('view/actor.php');
}

function acteur()
{
   // require('model/mainModel');
    $req = getActeur();
    $req = getBillets();
    require_once __DIR__.'/../view/home.php';
}

function commentaire()
{
    require('model/mainModel');
    if (isset($_GET['id_post']) && $_GET['id_post'] > 0) {
        $post = getPost($_GET['id_post']);
        $comments = getComments($_GET['id_post']);
        require('actor.php');
    }
    else {
        echo 'Erreur : aucun identifiant de billet envoyé';
    }

}

function CDE()
{
    $req = getBillets();
    require_once __DIR__.'/../view/CDE.php';
}



function Formation_co()
{
    require_once __DIR__.'/../view/Formation_co.php';
}

function Protectpeople()
{
    require_once __DIR__.'/../view/Protectpeople.php';
}

function DSA_France()
{
    require_once __DIR__.'/../view/DSA_France.php';
}

function forgetpass()
{
    require_once __DIR__.'/../view/forgetpass.php';
}


function registerTest()
{
  session_start();
  
  $erreur= 0;
  if(!empty($_POST)) { 
      //dd($_POST);
    $lastname=htmlspecialchars($_POST["nom"]);
    $firstname=htmlspecialchars($_POST["prenom"]);
    $username=htmlspecialchars($_POST["username"]);
    $passuser=md5($_POST["passuser"]);
    $checkpass=md5($_POST["checkpass"]);
    $question=htmlspecialchars($_POST["question"]);
    $reponse=htmlspecialchars($_POST["reponse"]); 
     if(empty($lastname)) {$erreur="Nom laissé vide!";}
     elseif(empty($firstname)) {$erreur="Prénom laissé vide!"; } 
     elseif(empty($username)) {$erreur="Nom d'utilisateur laissé vide!";}
     elseif(empty($passuser)) {$erreur="Mot de passe laissé vide!";}
     elseif($passuser!=$checkpass) {$erreur="Mots de passe non identiques!";}
     elseif(empty($question)) {$erreur="Question laissée vide!";}     
     elseif(empty($reponse)) {$erreur="Réponse laissée vide!";}
    else{   
        include_once  (__DIR__."/../db/connexiondb.php");
        $dbco=dbConnect();
        $sel=$dbco->prepare('SELECT * from account where username=? limit 1');
        $sel->execute(array($username));
        $tab=$sel->fetchAll();
        if(count($tab)>0){
            $erreur="Nom d'utilisateur existe déjà!";
        }
        else{
           $ins=$dbco->prepare("INSERT into account(nom,prenom,username,passuser,question,reponse) values(?,?,?,?,?,?)");
           if($ins->execute(array($lastname,$firstname,$username,md5($passuser),$question,$reponse))){
              // dd('redirection');
              header("location:index.php?action=login");
              exit;
            }   
        }
    }
  }
}