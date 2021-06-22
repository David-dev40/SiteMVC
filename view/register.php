<?php
$pageTitle = 'Inscription sur le site GBAF';
$header = 'noconnect'; 
ob_start();
require_once('controller/mainController.php');

?>


<main>
    <section class="form">
        <h1>Inscription</h1>
        <form action="index.php?action=registerTest" method="POST" >
        
            <p><input type="hidden" name="registerTest" value="registerTest" /></p>

            <p><label for="nom">Nom : </br></br></label><input type="text" name="nom" /></p>

            <p><label for="prenom">Prénom : </br></br></label><input type="text" name="prenom" /></p>

            <p><label for="username">Nom d'utilisateur : </br></br></label><input type="text" name="username" /></p>

            <p><label for="passuser">Mot de passe : </br></br></label><input type="password" name="passuser" /></p>

            <p><label for="checkpass">Confirmation du Mot de passe : </br></br></label><input type="password" name="checkpass" /></p>

            <p><label for="question">Question secrète : </br></br></label><input type="text" name="question" /></p>

            <p><label for="reponse">Réponse à la question secrète : </br></br></label><input type="text" name="reponse" /></p>

            <p><input type="submit" value="Validez"/></p>
            
        </form>
    </section>
</main>



<?php

$pageContent = ob_get_clean();

require_once __DIR__.'/../view/template.php';
?>







