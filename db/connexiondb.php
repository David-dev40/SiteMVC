<?php



function dbConnect(){
    $servname = 'localhost';
    $db = 'pdodb';
    $userdb = 'test';
    $passdb = '';
try{
    $dbco = new PDO("mysql:host=$servname;dbname=$db;charset=utf8", $userdb, $passdb,array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));

    } 
    catch (PDOException $e)
    {
        printf("Echec cnx bdd : %s\n", $e->getMessage());
        die('Erreur : '.$e->getMessage());
    }
    /*$requser=$dbco->query('SELECT * FROM account');
    
    while ($donnees = $requser->fetch())
    {   
        echo $donnees['nom'];

    } */


    return $dbco;
    echo ('ok cnx bdd');
}





