<main id="mainCompte">
    <article>
        <h2>INSCRIPTION</h2>
    </article>
    <article class="form">
        <form id="formInscription">
            <div class="formBloc" id="bloc1">
                <p>Vous êtes...</p>
                
                <input type="text" id="login" name="login" placeholder="identifiant">
                <input type="email" id="email" name="email" placeholder="email">
            </div>

            <div class="formBloc" id="bloc2">
                <input type="password" id="password" name="password" placeholder="mot de passe">
                <input type="password" id="password2" name="password2" placeholder="confirmez votre mot de passe">
                <p><em>*Le mot de passe doit comporter au moins 6 caractères, un caractère spécial et un chiffre.</em></p>
            </div>

            <div class="formBloc" id="bloc3">
                <button type="submit">S'inscrire</button>
            </div>
        </form>

        <div class="formInfo">
            <div id="message"></div>
        </div>
    </article>
  
</main>