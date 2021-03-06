<?php
$pageTitle = 'Groupement Banque Assurance Français';
$header = 'connect';
require_once('controller/mainController.php');
ob_start();
//require('mainController.php');
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        listPosts();
    }
    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
}
else {
    listPosts();
}
?>

<main>

<section id="presentation">
        <h1>Présentation du Groupement Banque Assurance Français</h1>
        <p>Le Groupement Banque Assurance Français (GBAF) est une fédération représentant les 6 grands groupes français :</p>
        <div class="presentationListActeurs">
            <ul>
                <li><span class="li_content">BNP Paribas ;</span></li>
                <li><span class="li_content">BPCE ;</span></li>
                <li><span class="li_content">Crédit Agricole ;</span></li>
            </ul>
            <ul>
                <li><span class="li_content">Crédit Mutuel-CIC ;</span></li>
                <li><span class="li_content">Société Générale ;</span></li>
                <li><span class="li_content">La Banque Postale ;</span></li>
            </ul>
        </div>
        <p>Même s'il existe une forte concurrence entre ces entités, elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes sur le territoire national. Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité bancaire à l'échelle nationale. C'est aussi un interlocuteur privilégié des pouvoirs publics.</p>
        <figure id="illustration"><img src="/SiteMVC/public/img/illustration.png" alt="illustration"/>
        </figure>
    </section>
    <section id="acteurs">
        <h2>Présentation des acteurs</h2>
        <p>Les produits et services bancaires sont nombreux et très variés. Afin de
            renseigner au mieux les clients, les salariés des 340 agences des banques et
            assurances en France (agents, chargés de clientèle, conseillers financiers, etc.)
            recherchent sur Internet des informations portant sur des produits bancaires et
            des financeurs, entre autres.
            Aujourd’hui, il n’existe pas de base de données pour chercher ces informations de
            manière fiable et rapide ou pour donner son avis sur les partenaires et acteurs du
            secteur bancaire, tels que les associations ou les financeurs solidaires.
            Pour remédier à cela, le GBAF souhaite proposer aux salariés des grands groupes
            français un point d’entrée unique, répertoriant un grand nombre d’informations
            sur les partenaires et acteurs du groupe ainsi que sur les produits et services
            bancaires et financiers.
            Chaque salarié pourra ainsi poster un commentaire et donner son avis.</p>
        <div id="conteneur_acteur">
        <?php foreach ($actors as $actor) : ?>
                <div class="acteur">
                    <div class="presentation_acteur">
                        <figure>
                            <img class="logo_acteur" src="<?= 'img' . DIRECTORY_SEPARATOR . $actor['logo_file']; ?>" alt="logo de l'acteur">
                        </figure>
                        <figcaption hidden>Logo de <?= $actor['acteur']; ?></figcaption>
                        <div class="description">
                            <h3><?= $actor['acteur']; ?></h3>
                            <p><?= substr($actor['description'], 0, 69) . '...'; ?></p>
                        </div>
                    </div>

                    <div class="votesButton">
                        <div class="homeVotes">
                            <p><span class="fas fa-thumbs-up fa-2x"> <?php if ($likesByActor[$actor['id_acteur']] == NULL) {
                                echo 0;
                            } else {echo $likesByActor[$actor['vote']];} ?></span></p>
                            <p><span class="fas fa-thumbs-down fa-2x"> <?php if ($dislikesByActor[$actor['id_acteur']] == NULL) {
                                echo 0;
                            } else {echo $dislikesByActor[$actor['vote']];} ?></span></p>
                        </div>
                        <a class="button" href="index.php?action=actor&amp;id_acteur=<?= $actor['id_acteur']; ?>">Lire la suite</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<?php
$pageContent = ob_get_clean();
require_once __DIR__.'/../view/template.php';
?>

