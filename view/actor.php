<?php
$pageTitle = $actor['acteur'];
$header = 'connect';
ob_start();
require('mainController.php');
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
    <section id="presentation_acteur">
        <figure class="logo_page_acteur">
            <img src="<?= 'img' . DIRECTORY_SEPARATOR . $actor['logo']; ?>" alt="logo de l'acteur"/>
        </figure>
        <figcaption hidden>Logo de <?= $actor['acteur']; ?></figcaption>
        <div class="description_page_acteur">
            <h2><?= $actor['acteur']; ?></h2>
            <p><?= $actor['description']; ?></p>
        </div>
        <div class="like">
            <span class="fas fa-thumbs-up fa-2x" style="color:green;"> <?= $like['vote']; ?></span>
            <span class="fas fa-thumbs-down fa-2x" style="color:red;"> <?= $dislike['vote']; ?></span>
        </div>
    </section>

    <section id="sectionComment">
        <?php if (empty($voteExist)) { ?>
            <div class="buttonLike">
                <form method="post">
                    <input type="hidden" name="actor_post" value="vote" />
                    <button type="submit" name="up"><span class="fas fa-thumbs-up fa-2x"></span></button>
                    <button type="submit" name="down"><span class="fas fa-thumbs-down fa-2x"></span></button>
                </form>
            </div>
        <?php } else { ?>
            <div class="newComment">
                <p>Vous avez déjà voté pour cet acteur</p>
            </div>
        <?php }

        if (empty($commentExist)) { ?>
            <div class="newComment">
                <h3>Mon commentaire</h3>
                <div class="form_newComment">
                    <form method="post">
                        <input type="hidden" name="actor_post" value="comment" />
                        <p><textarea name="comment" rows="4" cols="100" placeholder="Votre commentaire"><?= isset($comment) ? $comment : '' ?></textarea></p>
                        <p class="error"><?= isset($errorComment) ? $errorComment : '' ?></p>
                        <input type="submit" value="Envoyer" />
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="newComment">
                <p>Vous avez déjà commenté cet acteur</p>
            </div>
        <?php }?>

        <div>
            <h2>Commentaires</h2>
            <?php foreach ($comments AS $comment) : ?>
            <div class="commentaires">
                <div class="head_comment">
                    <div>
                        <p class="firstname"><?= $comment['prenom'] ?></p>
                        <p class="date_add">Posté le <?= $comment['date_add_fr'] ?></p>
                    </div>
                    <?php if ($votesByActor[$comment['id']] === '1') : ?>
                        <p><span class="fas fa-thumbs-up fa-2x"></span></p>
                    <?php elseif ($votesByActor[$comment['id']] === '0') : ?>
                        <p><span class="fas fa-thumbs-down fa-2x"></span></p>
                    <?php endif; ?>
                </div>
                <p class="comment"><?= $comment['post']; ?></p>
            </div>
        <?php endforeach; ?>
        </div>
    </section>
</main>

<?php

$pageContent = ob_get_clean();
require_once __DIR__.'/../view/template.php'
?>