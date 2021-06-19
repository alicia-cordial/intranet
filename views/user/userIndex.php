
<main id="mainCompte">
    <article>
        <h2> - ESPACE PERSONNEL - </h2>
        <h3><?= $_SESSION['user']['identifiant'] ?></h3>
        <ul>
            <li class="navUser" id="navUpdateProfil">Modifier le profil</li>
            <li class="navUser" id="navTdl">To do list</li>
            <li class="navUser" id="navAgenda">Agenda</li>
            <li><a href="views/user/messagerie.php">Messagerie</a></li>
        </ul>
    </article>
    <section id="sectionVendeur">
        <h3>...</h3>
    </section>

</main>