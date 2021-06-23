
<?php
$pageTitle = 'Mentions Légales';
$header = 'noconnect'; 
ob_start();
require_once('controller/mainController.php');
?>
<main>
 <h1>MENTIONS LÉGALES</h1>
<p></p>Conformément aux dispositions de la loi n° 2004-575 du 21 juin 2004 pour la confiance en l’économie numérique, il est précisé aux utilisateurs du site GBAF.fr l’identité des différents intervenants dans le cadre de sa réalisation et de son suivi.</p>

<h2>Edition du site</h2>
<p>Le site GBAF.fr est édité par RODRIGUES David, dont le siège social est situé à BISCARROSSE.</p>

<h2>Responsable de publication</h2>
<p>RODRIGUES David</p>

<h2>Hébergeur</h2>
<p>Le site GBAF.fr est hébergé par localhost</p>

<p>Adresse: BISCARROSSE</p>

<p>Le stockage des données personnelles des Utilisateurs est exclusivement réalisé sur les centre de données (“clusters”) localisés dans des Etats membres de l’Union Européenne de la société Amazon Web Services LLC</p>

<h2>Nous contacter</h2>
<p>Par email : drodrig.dev@gmail.fr.fr</p>

<h2>CNIL</h2>
<p>La société GBAF conservera dans ses systèmes informatiques et dans des conditions raisonnables de sécurité une preuve de la transaction comprenant le bon de commande et la facture.</p>

<p>La société GBAF a fait l’objet d’une déclaration à la CNIL sous le numéro .....</p>

<p>Conformément aux dispositions de la loi 78-17 du 6 janvier 1978 modifiée, l’Utilisateur dispose d’un droit d’accès, de modification et de suppression des informations collectées par GBAF. Pour exercer ce droit, il reviendra à l’Utilisateur d’envoyer un message à l’adresse suivante : drodrig.dev@gmail.fr</p>


</main>

<?php $pageContent=ob_get_clean();
require_once __DIR__.'/../view/template.php';
?>