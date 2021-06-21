<?php
$pageTitle = $actor['Protectpeople'];
$header='connect';
ob_start()
?>

<main>

    <section id= "presentation_acteur">
    <p><figure id="logo_page_acteur"><img src="public/img/actor_protectpeople.png" alt="actor_protectpeople"/>
        </figure><br />
        <div class="description">
    <p>Protectpeople finance la solidarité nationale.
Nous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.</p></br>

<p>Chez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.</p></br>
Proectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.</p></br>
Nous garantissons un accès aux soins et une retraite.
Chaque année, nous collectons et répartissons 300 milliards d’euros.
Notre mission est double :</p>
</div>
<div class="presentationListActeurs">
            <ul>
                <li><span class="li_content">social : nous garantissons la fiabilité des données sociales;</span></li>
                <li><span class="li_content">économique : nous apportons une contribution aux activités économiques.</span></li>
            </ul>
</div>
</main>

<?php
$pageContent= ob_get_clean();
require_once __DIR__.'/../view/template.php'
?>