<?php session_start(); ?>
<section id="sectionAdmin">
    <article id="articleForm">
        <h3>VOTRE PROFIL</h3>
        <h4>IDENTIFIANT : <?= $_SESSION['user']['identifiant'] ?></h4>
        <h4>IDENTIFIANT : <?= $_SESSION['user']['status'] ?></h4>
  
        <form id="formUpdateUser">
            <div>
                <label for="login">login</label>
                <input type="text" id="login" name="login" value="<?= $_SESSION['user']['identifiant'] ?>">
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="mot de passe">
                <input type="password" id="password2" name="password2" placeholder="confirmez votre mot de passe">
                <p><em>*Le mot de passe doit comporter au moins 6 caractères, un caractère spécial et un chiffre.</em>
            </div>
            <div>
                <input type="email" id="email" name="email" placeholder="email"
                       value="<?= $_SESSION['user']['mail'] ?>">
              
                <button type="submit">Modifier vos informations</button>
            </div>
        </form>
    </article>
    <div class="formInfo">
        <div id="message"></div>
    </div>

</section>