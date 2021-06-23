<?php
$pageTitle = 'DSA_France';
$header='connect';
ob_start()
?>

<main>
    
    <body>
    <?php while ($donnees = $req->fetch()) dd('test');  ?>
        <?php $actor=$donnees['DSA_France']; ?>
    <section id= "presentation_acteur">
    <p><figure id="logo_page_acteur"><img src=<?$donnees['logo'] ?> alt="actor_DSA_France"/>
        </figure><br />
    <div class="description"> 
    <?php echo $donnees['description']; ?>
    </div>
    </section>
    
        <div class="news">
            <h3>
                <? htmlspecialchars($donnees['id_user']); ?>
                <em>le <? $post['date_creation_fr']; ?></em>
            </h3>
            
            <p>
            <? nl2br(htmlspecialchars($post['post'])); ?>
            <br />
            </p>
        </div>
        <em><a href="#">Commentaires</a></em>
        <?
        while($comment = $comment->fetch())
        {
        ?>
            <p><strong><?= htmlspecialchars($comment['id_user']) ?></strong> le <?= $comment['date_creation_fr'] ?></p>
            <p><?= nl2br(htmlspecialchars($comment['post'])) ?></p>
        <?
        }
        ?>
    </body>
</main>

<?php
$pageContent= ob_get_clean();
require_once __DIR__.'/../view/template.php'
?>
