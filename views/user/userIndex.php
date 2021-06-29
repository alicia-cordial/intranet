
<main id="mainCompte" class="Userindex">
    <article>
    <h2><?= $_SESSION['user']['identifiant'] ?></h2>
        <h2> - ESPACE PERSONNEL - </h2>
        <section id="sectionVendeur">
        <h3></h3>
    </section>


        <ul class=indexUser>
            <div class="li1">
            <li class="navUser" id="navUpdateProfil"><img src="images/profil.png" alt="profil"></li>
            <li class="navUser" id="navMessagerie"><img src="images/messagerie.png" alt="messagerie"></li>
            <li class="navUser" id="navTdl"><img src="images/tdl.png" alt="tdl"></li>
            <li class="navUser" id="navAgenda"><img src="images/calendier.png" alt="calendrier"></li>
            </div>

            <div class="li2">
            <?php if ($_SESSION['user']['status'] == 1) : ?>
            <li class="navUser" id="navUsers"><img src="images/groupe.png" alt="groupe"></li>
            <li class="navUser" id="navEvent"><img src="images/calendrier.png" alt="evenement"></li>
            </div>
                <?php endif; ?>
        </ul>


    </article>


</main>