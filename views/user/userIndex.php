
<main id="mainCompte">
    <article>
        <h2> - ESPACE PERSONNEL - </h2>
        <h3><?= $_SESSION['user']['identifiant'] ?></h3>
        <ul>
            <li class="navUser" id="navUpdateProfil">Modifier le profil</li>
            <li class="navUser" id="navMessagerie">Messagerie</li>
            <li class="navUser" id="navTdl">To do list</li>
            <li class="navUser" id="navAgenda">Agenda</li>
            
            <?php if ($_SESSION['user']['status'] == 1) : ?>
            <li class="navUser" id="navUsers">Gérer les utilisateurs</li>
            <p>Ajoutez des nouvelles personnes <span class="callForm" id="callFormInscription">Inscrivez de nouvelles personnes.</span></p>
            <li class="navUser" id="navEvent">Ajouter des évènements</li>

                <?php endif; ?>
        </ul>
    </article>
    <section id="sectionVendeur">
        <h3>...</h3>
    </section>

</main>