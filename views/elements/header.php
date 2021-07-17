<header>
    <a href="home"><img src="images/icons8-accueil-48.png"/></a>
    <a href="compte">Compte</a>
    <?php if (isset($_SESSION['user']['id'])) : ?>
    <a href="sessiondestroy.php"><img src="images/icons8-sortie-48.png"/></a>
    <?php endif; ?>
</header>