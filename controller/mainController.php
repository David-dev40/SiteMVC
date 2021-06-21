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
    session_start();
    require_once __DIR__.'/../view/register';

}


function pageLogin()
{
    require_once __DIR__.'/../view/login.php';
}

function login()
{
    session_start();
    header("location:home.php");
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
        require('acteur.php');
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