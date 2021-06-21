<?php
$pageTitle = $actor['Formation&co'];
$header='connect';
ob_start()
?>

<main>

    <section id= "presentation_acteur">
    <p><figure id="logo_page_acteur"><img src="public/img/actor_formation_co.png" alt="actor_formation&co"/>
        </figure><br />
    <div class="description">
    <p>Formation&co est une association française présente sur tout le territoire.
Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.
Notre proposition :</p>
    </div>
<div class="presentationListActeurs">
            <ul>
                <li><span class="li_content">Un financement jusqu’à 30 000 € ;</span></li>
                <li><span class="li_content">Un suivi personnalisé et gratuit ;</span></li>
                <li><span class="li_content">Une lutte acharnée contre les freins sociétaux et les stéréotypes ;</span></li>
            </ul>
</div>

<p>Le financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.
Vous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.</p>
</section>
</main>
<?php
$pageContent= ob_get_clean();
require_once __DIR__.'/../view/template.php'
?>