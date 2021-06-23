<?php
$pageTitle = 'Contact';
$header = 'noconnect'; 
ob_start();
require_once('controller/mainController.php');
?>

<h1>drodrig.dev@gmail.fr</h1>

<?php $pageContent=ob_get_clean();
require_once __DIR__.'/../view/template.php';
?>