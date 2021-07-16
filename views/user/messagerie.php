<?php 
session_start(); 

if (empty($_SESSION)) {
    header("Location: index.php");
} else {
    require_once('../../models/UserModel.php');
    $model = new UserModel();
 
  
}?>


<button id="myBtn"> Messagerie</button>
<section id="sectionVendeur" class="sectionMessagerie">  
  <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content" id="modal-content">
  <span class="close">&times;</span>
 
 
  <section id="tableLists">

    <div>
        <p class="messagerie" value="">Tous</p>
    </div>
</article>

<article id="listeMessages">

</article>

<article id="infoAdmin">

</article>
<!--<img src="images/giphy.svg"/>-->
    <form id="formMessagerie">
        <input type="text" id="idUser" hidden value="<?= $_SESSION['user']['id'] ?>">
        <input type="text" id="contenu" placeholder="Type in your message right here bro !" required>
        <button type="submit" class="submit">🔥 Send !</button>
    </form>

<div id="infoMessage"></div>

 



</div>

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


$(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            $('.s3cc-fixed').css('position','static');
        }else{
            $('.s3cc-fixed').css('position','fixed');
        }
    });
</script>


      