<?php



function dbConnect(){
    $servname = 'localhost';
    $db = 'pdodb';
    $userdb = 'test';
    $passdb = '';
try{
    $dbco = new PDO("mysql:host=$servname;dbname=$db;charset=utf8", $userdb, $passdb,array(PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION));
    return $dbco;

    } 
    catch (PDOException $e)
    {
    die('Erreur :' .$e->getMessage());
    }
}





