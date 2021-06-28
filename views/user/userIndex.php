
<main id="mainCompte" class="Userindex">
    <article>
    <h2><?= $_SESSION['user']['identifiant'] ?></h2>
        <h2> - ESPACE PERSONNEL - </h2>
        <section id="sectionVendeur">
        <h3></h3>
    </section>

        <ul class=indexUser>
            <li class="navUser" id="navUpdateProfil"><img src="images/profil.png" alt="profil"></li>
            <li class="navUser" id="navMessagerie"><img src="images/messagerie.png" alt="messagerie"></li>
            <li class="navUser" id="navTdl"><img src="images/tdl.png" alt="tdl"></li>
            <li class="navUser" id="navAgenda"><img src="images/calendier.png" alt="calendrier"></li>
            
            <?php if ($_SESSION['user']['status'] == 1) : ?>
            <li class="navUser" id="navUsers">Gérer les utilisateurs</li>
            <p>Ajoutez des nouvelles personnes <span class="callForm" id="callFormInscription">Inscrivez de nouvelles personnes.</span></p>
            <li class="navUser" id="navEvent">Ajouter des évènements</li>

                <?php endif; ?>
        </ul>
    </article>


</main>