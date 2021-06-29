<section id="sectionVendeur">

<button id="myBtn"> Gestion</button>
    
  <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content" id="modal-content">
  <span class="close">&times;</span>


<article>
    <h3>UTILISATEURS</h3>
    <!--    <p>Nombre d'inscrit.es : </p>-->
    <div>
        <p class="showUsers" value="">Tous</p>
    </div>
</article>

<article id="listeUsersTries">

</article>

<article id="infoAdmin">

</article>

<p>+ <span class="callForm" id="callFormInscription">Inscrivez de nouvelles personnes.</span></p>


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


</script>

