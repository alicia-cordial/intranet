<section class="sectionVendeur">
    <article id="tacheForm">

<form class="formUpdateTache" id="<?= $tache['id'] ?>">
    
    <input type="text" id="titre" name="titre" placeholder="titre" value="<?= $tache['titre'] ?>">
    <label for="titre">Titre</label>
   
    
    <button type="submit">Modifier la tâche</button>
</form>
</article>

<div class="formInfo">
    <div id="message"></div>
</div>

</section>