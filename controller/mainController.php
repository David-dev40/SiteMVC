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

/*function register()
{
    
  require_once __DIR__.'/../view/register';

}*/


function pageLogin()
{
    require_once __DIR__.'/../view/login.php';
}

function login()
{
    session_start();
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
            $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
            " ".strtoupper($tab[0]["nom"]);
            $_SESSION["autoriser"]="oui"; 
            $_SESSION['nom']; 
            $_SESSION['prenom'];
            header("location:index.php?action=home"); 
        }
        else{
            $erreur="Mauvais nom d'utilisateur ou mot de passe!";
            dd($erreur);
            
        }
        

    }
   /* <p><a href="index.php?action=login"><?= $_SESSION['nom']; ?> <?= $_SESSION['prenom']; ?></a></p>*/

  
    require_once __DIR__.'/../view/login.php';
}


function logout()
{
    session_start();
    session_destroy();

    header("location: index.php?action=login");
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


function register()
{
  $dbco=dbconnect();
  session_start();
  
  $erreur= 0;
  if(isset($_POST['SEnregistrer'])){ 
      
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
            $passuser=htmlspecialchars($_POST["passuser"]);
            $passuser=md5($passuser);
            $question=htmlspecialchars($_POST["question"]);
            $reponse=htmlspecialchars($_POST["reponse"]);

            $ins=$dbco->prepare('SELECT * from account where username=? limit 1');
            $ins->execute(array($username));
            $tabins=$ins->fetchAll();
            if(count($tabins)==0){
                echo '<script>alert("Vous êtes enregistré !")</script>';
            }
            else{
                $ins=$dbco->prepare("INSERT into account(nom,prenom,username,passuser,question,reponse) values('$lastname','$firstname','$username','$passuser','$question','$reponse')");
                 if($ins->execute(array($lastname,$firstname,$username,md5($passuser),$question,$reponse))){
                  
                  header("location:index.php?action=login");
                  exit;
                 }
            }
         }  
    }

}