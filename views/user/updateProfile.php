<?php session_start(); ?>
<section id="sectionVendeur">

<div class="container">
<p class="containerContactUser"><a class='Update' href='#ex1' rel='modal:open'></a></p>

        <form id="formUpdateUser" class="formUpdateUser">
            <div>
                <input type="text" id="login" name="login" value="<?= $_SESSION['user']['identifiant'] ?>">
                <input type="email" id="email" name="email" placeholder="email"
                       value="<?= $_SESSION['user']['mail'] ?>">
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="mot de passe">
                <input type="password" id="password2" name="password2" placeholder="confirmez votre mot de passe">
                <p><em>*Le mot de passe doit comporter au moins 6 caractères, un caractère spécial et un chiffre.</em>
            </div>
            <div>
                
              
                <button type="submit">Modifier vos informations</button>
            </div>
        </form>
    </article>
    <div class="formInfo">
        <div id="message"></div>
    </div>

    </div>

 
      </section>



