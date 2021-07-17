

<main id="mainCompte" class="Userindex">
    <article>
    <h2><?= $_SESSION['user']['identifiant'] ?></h2>
        <h2> - ESPACE PERSONNEL - </h2>
        <section id="sectionVendeur">
        <h3></h3>
    </section>
<!--
    <meteo-widget dark units="metric" lang="fr" city="Toulouse"></meteo-widget>
    <meteo-widget units="fahrenheit" lang="en" city="New York"></meteo-widget>
    <meteo-widget dark city="Lyon"></meteo-widget>

-->
        <ul class=indexUser>
            <div class="li1">
            <li class="navUser" id="navUpdateProfil"><a href='#ex1' rel='modal:open'><img src="images/profil.png" alt="profil"></a></li>
            <li class="navUser" id="navMessagerie"><a href='#ex1' rel='modal:open'><img src="images/messagerie.png" alt="messagerie"></a></li>
            <li class="navUser" id="navTdl"><a href='#ex1' rel='modal:open'><img src="images/tdl.png" alt="tdl"></a></li>
            <li class="navUser" id="navAgenda"><a href='#ex1' rel='modal:open'><img src="images/calendier.png" alt="calendrier"></a><li>
            </div>

            <div class="li2">
            <?php if ($_SESSION['user']['status'] == 1) : ?>
            <li class="navUser" id="navUsers"><a href='#ex1' rel='modal:open'><img src="images/groupe.png" alt="groupe"></a></li>
            <li class="navUser" id="navEvent"><a href='#ex1' rel='modal:open'><img src="images/calendrier.png" alt="evenement"></a></li>
            </div>
                <?php endif; ?>
        </ul>


    </article>


</main>
