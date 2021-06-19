<?php session_start(); ?>

<section id="sectionVendeur">
  





<article>
   
    <button id="addNewTache">Ajouter une tache</button>
    <div id="tachesVides"><h4> Vide</h4></div>
    <div id="taches"><h4>Taches</h4></div>
</article>

<article id="articlesTries">
<section id="container_todo"></section>
</article>

<article id="infoAdmin">

</article>

<div id="ex1" class="modal">
    <div id="nameDestinataire"></div>
    <form id='newMessage'>
        <input placeholder='votre message' required>
        <button type='submit'>Envoyer</button>
    </form>
    <div id="infoMessage"></div>
    <a href="#" rel="modal:close">Close</a>
</div>
</section>
