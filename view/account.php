<?php
$pageTitle = 'Mon compte sur le site GBAF';
$header = 'connect';
ob_start();
?>

<main id="account">
    

    <section class="form">
        <h2>Changer mon nom d'utilisateur</h2>
        <form action="index.php?action=account" method="POST" novalidate>
            <input type="hidden" name="account_form" value="username" />
            <p><label for="username">Nom d'utilisateur : </label><br /><input type="text" name="username" id="username" value='' /></p>
            <p><class="error"><?= isset($errorUsername) ? $errorUsername : '' ?></p>
            <p><class="confirm"><?= isset($confirmUsername) ? $confirmUsername : '' ?></p>
            <input type="submit" value="Validez les changements">
        </form>
    </section>

    <section class="form">
        <h2>Changer mon mot de passe</h2>
        <form action="index.php?action=account" method="POST" novalidate>
            <input type="hidden" name="account_form" value="passuser" />
            <p><label for="newpass">Mon nouveau mot de passe : </label></p>
            <p><input type="password" name="newpass" id="newpass" required /></p>
            <p><class="error"><?= isset($errorPass) ? $errorPass : '' ?></p>
            <p><label for="checkpass">Confirmation du nouveau mot de passe : </label><br /><input type="password" name="checkpass" id="checkpass" required /></p>
            <p><class="error"><?= isset($diffPass) ? $diffPass : '' ?></p>
            <p><class="confirm"><?= isset($confirmPassword) ? $confirmPassword : '' ?></p>
            <input type="submit" value="Validez les changements">
        </form>
    </section>

    <section class="form">
        <h2>Changer mon nom</h2>
        <form action="index.php?action=account" method="POST" novalidate>
            <input type="hidden" name="account_form" value="nom" />
            <p><label for="nom">Nom : </label><br /><input type="text" name="nom" id="nom" value='' /></p>
            <p><class="error"><?= isset($errorLastname) ? $errorLastname : '' ?></p>
            <p><class="confirm"><?= isset($confirmLastname) ? $confirmLastname : '' ?></p>
            <input type="submit" value="Validez les changements">
        </form>
    </section>

    <section class="form">
        <h2>Changer mon pr??nom</h2>
        <form action="index.php?action=account" method="POST" novalidate>
            <input type="hidden" name="account_form" value="prenom" />
            <p><label for="prenom">Pr??nom : </label><br /><input type="text" name="prenom" id="prenom" value='' /></p>
            <p><class="error"><?= isset($errorFirstname) ? $errorFirstname : '' ?></p>
            <p><class="confirm"><?= isset($confirmFirstname) ? $confirmFirstname : '' ?></p>
            <input type="submit" value="Validez les changements">
        </form>
    </section>

    <section class="form">
        <h2>Changer ma question secr??te et sa r??ponse</h2>
        <form action="index.php?action=account" method="POST" novalidate>
            <input type="hidden" name="account_form" value="question" />
            <p><label for="question">Ma nouvelle question : </label><br /><input type="text" name="question" id="question" value='' /></p>
            <p><class="error"><?= isset($errorQuestion) ? $errorQuestion : '' ?></p>
            <p><label for="reponse">Ma nouvelle r??ponse : </label><br /><input type="text" name="reponse" id="reponse" value=''/></p>
            <p><class="error"><?= isset($errorAnswer) ? $errorAnswer : '' ?></p>
            <p><class="confirm"><?= isset($confirmQuestion) ? $confirmQuestion : '' ?></p>
            <input type="submit" value="Validez les changements">
        </form>
    </section>

</main>

<?php
$pageContent = ob_get_clean();
require_once __DIR__.'/../view/template.php';
?>
