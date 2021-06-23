<?php 
session_start(); 

if (empty($_SESSION)) {
    header("Location: index.php");
} else {
    require_once('../../models/UserModel.php');
    $model = new UserModel();
    $messagesUser = $model->selectMessage($_SESSION['user']['id']);
  
}?>

<section id="sectionVendeur">

<button id="myBtn"> To do list</button>
    <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content" id="modal-content">
  <span class="close">&times;</span>

    <section id="tableLists">

    <article class="list">
        
        <form methode="post">
            <input type="text" id="userId" hidden value="<?= $_SESSION['user']['id'] ?>">
            <input type="text" id="titleTask" placeholder="Ajouter une tache">
            <button class="addTask"> +</button>
        </form>
    </article>



    <article class="list">
        <h3>Taches terminées</h3>
        <ul id="doneList">
            <?php foreach ($tasksUser['done'] as $key => $task) : ?>
                <li class="liTask" id="<?= $task['id'] ?>">
                    <input class="liTaskTitle" readonly="readonly" value="<?= $task['titre'] ?>">
                    <span><input type='checkbox' checked disabled class='liTaskEnd'> <?= $task['date_fin'] ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </article>
  
    <article class="list" onclick="displayArchive()" id="containerArchive">
        <h3>Taches archivées</h3>
        <ul id="archiveList">
            <?php foreach ($tasksUser['archive'] as $key => $task) : ?>
                <li class="liTask" id="<?= $task['id'] ?>">
                    <input class="liTaskTitle" readonly="readonly" value="<?= $task['titre'] ?>">
                </li>
            <?php endforeach; ?>
        </ul>

    </article>
    </section>

</section>



</div>

</div>


<script>


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