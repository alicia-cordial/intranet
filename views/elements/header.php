<header>
    <a href="home">Home</a>
    <a href="compte">Compte</a>
    <?php if (isset($_SESSION['user']['id'])) : ?>
    <a href="sessiondestroy.php">Déconnexion</a>
    <?php endif; ?>
</header>