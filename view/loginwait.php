<?php
$pageTitle = 'Connexion à GBAF';
$header = 'noconnect'; 
//dd('test');
ob_start();
?>

<main>
    <section class="form">
        <h1>Connectez-vous</h1>
        <form method="post" action="index.php?action=connexion">

            <p><label for="Username">Nom d'utilisateur : </label><br /></br><input type="text" name="Username" id="Username" value="<?= isset($_POST['Username']) ? $_POST['Username'] : '' ?>" required /></p>

            <p><label for="Passuser">Mot de passe : </label><br /></br><input type="password" name="Passuser" id="Passuser" required /></p>
            <p class="error"><?= isset($errorMsg) ? $errorMsg : '' ?></p></br>

            <p><input type="submit" value="Se connecter" /></p></br>
            
        </form>
        <p>Pas encore de compte ? <a href="index.php?action=pageRegister">Inscrivez-vous !</a></p>
        <p>Mot de passe oublié ? <a href="index.php?action=forgetpass">Créer un nouveau mot de passe</a></p>
    </section>
</main>

<?php
$pageContent = ob_get_clean();
require_once __DIR__.'/../view/template.php';
?>