<?php
$pageTitle = $actor['DSA_France'];
$header='connect';
ob_start()
?>

<main>

    <section id= "presentation_acteur">
    <p><figure id="logo_page_acteur"><img src="public/img/actor_Dsa_france.png" alt="actor_DSA_France"/>
        </figure></p><br />
    <div class="description">
    <p>Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.
Nous accompagnons les entreprises dans les étapes clés de leur évolution.
Notre philosophie : s’adapter à chaque entreprise.
Nous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises</p>
    </div>
    </section>
</main>

<?php
$pageContent= ob_get_clean();
require_once __DIR__.'/../view/template.php'
?>