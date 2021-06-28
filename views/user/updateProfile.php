<?php session_start(); ?>
<section id="sectionVendeur">
<button id="myBtn"> Profil</button>
    
    <!-- The Modal -->
  <div id="myModal" class="modal">
      <section class="updateProfil">
  
  <!-- Modal content -->
  <div class="modal-content" id="modal-content">
    <span class="close">&times;</span>
    <article id="articleForm">


        <form id="formUpdateUser" class="formUpdateUser">
            <div>
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


    </div>
      </section>
</div>

</section>



<script type="text/javascript">



// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

</script>

